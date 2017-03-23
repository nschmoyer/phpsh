<?php

namespace phpsh;

use Symfony\Component\Yaml\Parser;

Class CommandMap
{
	private $commandMap;

	public function __construct()
	{
	    $customCommands = null;

		// get the command.yml file and map it out as an array
		$yaml = new Parser();
		$this->commandMap = $yaml->parse(
			file_get_contents(__DIR__.'/config/commands.yml')
		);

		// In addition, search for a custom phpsh.yml file and add those commands on top of the default ones
        // Look in a few directories for a separate phpsh.yml config file
        $files = array(
            __DIR__ . '/../../../../../phpsh.yml',
            __DIR__ . '/../../../../../app/phpsh.yml',
            __DIR__ . '/../../../../../config/phpsh.yml',
            __DIR__ . '/../../../../../app/config/phpsh.yml',
        );

        foreach ($files as $file) {
            if (file_exists($file)) {
                // override the prompt config
                $customCommands = $yaml->parse(file_get_contents($file));

                break;
            }
        }

        if ($customCommands && !empty($customCommands['commands'])) {
            foreach ($customCommands['commands'] as $key => $command) {
                $this->commandMap[$key] = $command;
            }
        }

	}

	public function getCommandMap()
	{
		return $this->commandMap;
	}
}