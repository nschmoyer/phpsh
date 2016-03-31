<?php
/**
 * COMMAND class for phpsh.
 */

namespace phpsh;

use Symfony\Component\Yaml\Parser;

class Command
{

	private $args;

	public function __construct($args = [])
	{

	}

	public function setArgs($num)
	{
		$this->args = $num;
	}

	public function getArgs()
	{
		return $this->args;
	}

	/**
	 * Output text to the terminal.
	 *
	 * If no $string is provided, it will just output a newline.
	 */
	protected function write($string = null)
	{
		if ($string) {
			echo $string;
		}

		echo "\n";
	}

}