<?php
/**
 * RUNNER class for phpsh.
 *
 * This is the main "runner" for the application. It creates the console prompt,
 * accepts input, and invokes the Command class to look for the appropriate
 * output.
 */

namespace phpsh;

use phpsh\CommandMap;
use phpsh\Prompt;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Yaml\Parser;

class Runner
{

	public function __construct()
	{
		$this->prompt = new Prompt();
		$this->prompt->setConfigFile(__DIR__.'/config/prompt.yml');

		$this->log = new Logger('commands');
		$this->log->pushHandler(new StreamHandler(__DIR__.'/../../log/commands.log', Logger::INFO));

	}

	/**
	 * This is the main looping function that takes user input, searches for
	 * valid commands, and spits out a result.
	 */
	public function run()
	{
		$input = null;

		while (1) {

			$input = $this->outputPrompt();

			$this->runCommand($input);

		}
	}

	private function outputPrompt()
	{

		echo $this->prompt->getPrompt();
		return rtrim( fgets( STDIN ), "\n" );

	}

	private function runCommand($input)
	{
		$cmd = $this->getCommand($input);
		$args = $this->getArgs($input);

		// get the command.yml file and map it out as an array
		$map = new CommandMap();
		$commandMap = $map->getCommandMap();

		if (array_key_exists($cmd, $commandMap)) {

			$this->log->addInfo('Exec command: '.$cmd, $args);
			
			$class = $commandMap[$cmd]['class'];
			$command = new $class($args);
			$command->exec();

		} else {

			$this->log->addError('Invalid command: '.$cmd, $args);

			echo "Command not found.\n";

		}

	}

	/**
	 * Given an input string of multiple characters,
	 * find the command (i.e. the first word)
	 */
	private function getCommand($input)
	{

		$input = trim(strtolower($input));
		$input = explode(' ', $input);

		return $input[0];

	}

	/**
	 * Given an input string of multiple words,
	 * find the arguments (.e. the second and following words)
	 */
	private function getArgs($input)
	{

		$input = trim($input);
		$input = explode(' ', $input);

		$args = [];

		for ($i = 0; $i < count($input); $i++) {
			if ($i > 0) {
				$args[] = $input[$i];
			}
		}

		return $args;
		
	}

}