<?php

namespace phpsh\Tests;

use phpsh\Command;

class CommandTest extends TestExtension
{

	public function testGetArgs()
	{
		$a = new Command();
		$a->setArgs(1);

		$this->assertEquals($a->getArgs(), 1);
	}

	public function testWriteNullString()
	{
		$a = new Command();
		
		$this->expectOutputString("\n");
		$this->invokeMethod($a, "write", []);
	}

}