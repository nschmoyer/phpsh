<?php
/**
 * PROMPT class for phpsh.
 *
 * This is the main "runner" for the application. It creates the console prompt,
 * accepts input, and invokes the Command class to look for the appropriate
 * output.
 */

namespace phpsh;

class Prompt
{

	public function __construct()
	{
		$this->prompt = "# ";
	}

	public function run()
	{
		$input = null;

		while ($this->getCommand($input) !== "exit") {

			$input = $this->outputPrompt();

		}
	}

	private function outputPrompt()
	{

		echo $this->prompt;
		return rtrim( fgets( STDIN ), "\n" );

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