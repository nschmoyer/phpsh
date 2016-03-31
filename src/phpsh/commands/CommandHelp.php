<?php

/**
 * This is a template file to be used for creating new commands. Make a copy
 * of this file, rename it to "Command{Name}.php", and rename the class as well.
 *
 * The exec() function is invoked in the Runner class whenever a user inputs
 * this command.
 */

namespace phpsh\Commands;

class CommandHelp extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		$this->write("Here is a sample command output.");
	}
}