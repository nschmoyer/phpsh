<?php

namespace phpsh;

use Symfony\Component\Yaml\Parser;

class Prompt
{
	private $configFile;

	public function getPrompt()
	{

		$yaml = new Parser();

		if ($this->getConfigFile()) {

			$prompt = $yaml->parse(
				file_get_contents($this->getConfigFile())
			);

			$prompt = $prompt['prompt'];

			return $this->convertVariables($prompt);

		} else {

			return "# ";

		}
	}

	private function convertVariables($prompt)
	{

		$prompt = str_replace("{{ time }}", date('H:i:s', time()), $prompt);
		$prompt = str_replace("{{ date }}", date('Y-m-d', time()), $prompt);

		return $prompt;

	}

	public function setConfigFile($configFile)
	{
		$this->configFile = $configFile;
	}

	public function getConfigFile()
	{

		if ($this->configFile) {
			return $this->configFile;
		} else {
			return false;
		}

	}
}