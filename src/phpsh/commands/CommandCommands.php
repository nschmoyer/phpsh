<?php

namespace phpsh\Commands;

use phpsh\CommandMap;

class CommandCommands extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		$cm = new CommandMap();
		$commands = $cm->getCommandMap();
		ksort($commands);

		foreach ($commands as $key => $value) {
			$this->write($key);
		}
	}
}