<?php

namespace phpsh\Commands;

// use namespace\Class;

class CommandShutdown extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		$this->write("\nPowering off.\n");
	}
}