<?php

namespace phpsh\Tests;

use phpsh\Prompt;

class PromptTest extends TestExtension
{

	public function testLoadWithoutConfigFile()
	{
		$a = new Prompt();
		$prompt = $a->getPrompt();

		$this->assertEquals($prompt, "# ");
	}

}