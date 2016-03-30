<?php

use phpsh\Command;

class CommandTest extends \PHPUnit_Framework_TestCase
{

	public function testGetArgs()
	{
		$a = new Command();
		$a->setArgs(1);

		$this->assertEquals($a->getArgs(), 1);
	}

}