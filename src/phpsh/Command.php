<?php
/**
 * COMMAND class for phpsh.
 */

namespace phpsh;

class Command
{

	private $args;

	public function setArgs($num)
	{
		$this->args = $num;
	}

	public function getArgs()
	{
		return $this->args;
	}

}