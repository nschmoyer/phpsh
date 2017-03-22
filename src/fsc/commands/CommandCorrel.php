<?php

namespace fsc\Commands;

// use namespace\Class;

class CommandCorrel extends \phpsh\Command
{
	/**
	 * Run the command.
	 */
	public function exec()
	{
		$corr = $this->correlation([1,2,3], [3,2,1]);
		$this->write($corr);
	}

	private function correlation($x, $y)
	{
		$length = count($x);
		$mean1 = array_sum($x) / $length;
		$mean2 = array_sum($y) / $length;

		$axb = 0;
		$a2 = 0;
		$b2 = 0;

		for ($i = 0; $i < $length; $i++) {
			$a = $x[$i] - $mean1;
			$b = $y[$i] - $mean2;
			$axb = $axb + ($a * $b);
			$a2 = $a2 + pow($a, 2);
			$b2 = $b2 + pow($b, 2);
		}

		$corr = $axb / sqrt($a2 * $b2);

		return $corr;
	}
}