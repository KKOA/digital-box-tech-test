<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 11/06/2022
 */
declare(strict_types=1);

require_once("functions.php");

/**
 * Class Calc
 */
class Calc
{
	/**
	 * @var float
	 */
	private float $result;
	private bool $debug;

	/**
	 * Calc constructor.
	 * @param $initialValue
	 */
	public function __construct($initialValue,$debug = false)
	{
		$this->result = $initialValue;
		$this->debug = $debug;
	}

	/**
	 * @param array $instructions
	 * @param array $numbers
	 * @return float
	 */
	public function executeInstructions (array $instructions, array $numbers) :float {

		foreach($instructions as $key => $currentInstruction)
		{
			$currentNumber = floatval($numbers[$key]);
			$this->result = $this->executeInstruction($this->result,$currentInstruction, $currentNumber);
		}
		return $this->result;
	}

	/**
	 * @param float $result
	 * @param string $instruction
	 * @param float $number
	 * @return float
	 */
	private function executeInstruction (float $result, string $instruction, float $number) :float {
		switch($instruction) {
			case "add":
			case "subtract":
			case "multiply":
			case "divide":
				$currentValue = $this->result;
				$this->$instruction($number);
				$newValue = $this->result;
				if(debugMode($this->debug)) {
					echo "action: $instruction\n";
					echo "Current value: $currentValue\n";
					echo "Number: $number\n";
					echo "New Value: $newValue\n\n";
				}

				break;
			default:
				print $instruction." is invalid command.\n\n";
		}
		return $this->result;
	}

	/**
	 * @param $number
	 */
	private function add($number) :void{
		$this->result += $number;
	}

	/**
	 * @param $number
	 */
	private function subtract($number) :void {
		$this->result -= $number;
	}

	/**
	 * @param $number
	 */
	private function multiply($number) :void {
		$this->result *= $number;
	}

	/**
	 * @param $number
	 */
	private function divide($number) :void{
//		die("number $number");

		if(floatval($number) !== 0.0) {
			$this->result /= $number;
		}
	}

}