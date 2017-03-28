<?php

namespace phpsh;

class Prompt
{
    private $prompt;

	public function setPrompt($prompt)
    {
        $this->prompt = $prompt;
    }

	public function getPrompt()
	{
		if ($this->prompt) {

			return $this->convertVariables($this->prompt);

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
}