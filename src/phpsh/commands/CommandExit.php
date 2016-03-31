<?php

namespace phpsh\Commands;

class CommandExit extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		exit(1);
	}
}