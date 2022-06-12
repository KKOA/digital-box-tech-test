<?php
declare(strict_types=1);
/**
 * Created by : PhpStorm.
 * Describe: Extract valid instruction and numbers from file provide to it.
 * User : keith
 * Date : 04/06/2022
 */
require_once("functions.php");

/**
 * Class FileInstructionReader
 */
class FileInstructionReader
{
	/**
	 * @var string $filename
	 */
	private string $filename;

	/**
	 * @var bool $debug
	 */
	private bool $debug;

	/**
	 * FileInstructionReader constructor.
	 * @param string $filename
	 * @param bool $debug
	 */
	public function __construct(string $filename, bool $debug = false) {
		$this->filename = $filename;
		$this->debug = $debug;
	}

	/**
	 * @param string $instruction
	 * @param string $number
	 * @return bool
	 */
	public function isValidLine(string $instruction, string $number) :bool
	{
		return $this->isValidInstruction($instruction) && $this->isValidNumber($number);
	}

	/**
	 * Return true if text is valid instruction
	 *
	 * @param string $str
	 * @param array VALID_INSTRUCTION
	 * @return boolean
	 */
	private function isValidInstruction(string $str, array $validInstruction = VALID_INSTRUCTION) :bool{
		return in_array($str, $validInstruction);
	}
	/**
	 * Return true if text is valid number
	 *
	 * @param string $str
	 * @return boolean
	 */
	private function isValidNumber($str) :bool
	{
		return is_numeric($str);
	}

	/**
	 * Remove trail and convert multiple consecutive spaces into single space
	 *
	 * @param string $str
	 * @return string
	 */
	private function removeDuplicateSpaces(string $str) :string
	{
		return trim(preg_replace('!\s+!', ' ', $str));
	}

	public function getInstructions () :array {

		$initialValue = 0;
		$instructions = [];
		$numbers = [];

		$myFile = fopen($this->filename,"r"); // Open for "reading only" and place the file pointer at the beginning of the file.

		if(debugMode($this->debug)) print "\nContents of the file are : \n";

		while (!feof($myFile)) //Loops while file pointer has not reached end-of-file.
		{
			$line = fgets($myFile); // Get current line from file
			if($line === false)
			{
				continue;
			}

			$line = $this->removeDuplicateSpaces(strtolower($line));

			if(debugMode($this->debug)) print 'line : '.$line."\n";


			if(count(explode(" ", $line)) < 2){
				list($instruction) = explode(" ", $line);

				//If no number is given on the same line as the “apply” instruction then set initial value to zero
				if($instruction !== 'apply'){
					continue;
				}
				$line ="$instruction 0";
			}

			list($instruction, $number) = explode(" ", $line);

			//Skip if instruction or number is invalid
			if(!$this->isValidLine($instruction,$number)){
				continue;
			}

			// exit loop if get instruction apply. If in
			if($instruction === 'apply') {
				//set initialValue && break out of loop
				$initialValue = floatval($number);
				break;
			} else {
				//Add instruction to instructions && Add value to numbers
				$instructions[] = $instruction;
				$numbers[] = $number;
			}

		}

		fclose($myFile); // The file pointed to by handle is closed.

		if(debugMode($this->debug)){
			$this->printInstructionsAndNumbers($instructions,$numbers);
		}


		return [$initialValue, $instructions, $numbers];
	}

	/**
	 * @param array $instructions
	 * @param array $numbers
	 */
	private function printInstructionsAndNumbers(array $instructions, array $numbers){
		print_r($instructions);
		print_r($numbers);
	}
}
