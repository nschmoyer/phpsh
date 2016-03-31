<?php

namespace phpsh;

use Symfony\Component\Yaml\Parser;

Class CommandMap
{
	private $commandMap;

	public function __construct()
	{
		// get the command.yml file and map it out as an array
		$yaml = new Parser();
		$this->commandMap = $yaml->parse(
			file_get_contents(__DIR__.'/config/commands.yml')
		);
	}

	public function getCommandMap()
	{
		return $this->commandMap;
	}
}