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
        $yaml = new Parser();

		// Look in a few directories for a separate phpsh.yml config file
        // If not found in the project directory, use the default phpsh.yml that comes with the library
        $files = array(
            __DIR__ . '/../../../../../phpsh.yml',
            __DIR__ . '/../../../../../app/phpsh.yml',
            __DIR__ . '/../../../../../config/phpsh.yml',
            __DIR__ . '/../../../../../app/config/phpsh.yml',
            __DIR__ . '/config/phpsh.yml',
        );

        foreach ($files as $file) {
            if (file_exists($file)) {

                $this->config = $yaml->parse(file_get_contents($file));

                if (isset($this->config['prompt'])) {
                    $this->prompt->setPrompt($this->config['prompt']);
                }

                break;
            }
        }
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
			
			$class = $commandMap[$cmd]['class'];
			$command = new $class($args);
			$command->exec($args);

		} else {

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