<?php

namespace phpsh\Tests;

use phpsh\Prompt;

class PromptTest extends \PHPUnit_Framework_TestCase
{

	public function testLoadWithoutConfigFile()
	{
		$a = new Prompt();
		$prompt = $a->getPrompt();

		$this->assertEquals($prompt, "# ");
	}

}