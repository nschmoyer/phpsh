<?php

namespace phpsh\Commands;

// use namespace\Class;

class CommandStartup extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		$this->write("\nWelcome to phpsh.\n");
	}
}