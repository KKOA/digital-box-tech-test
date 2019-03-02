<?php
/* 
Description : Read information from another file. Depending on this information read output appropriate results.
Author : Keith Amoah
Date : 04/01/2016
*/

    /**
     * Return true if text is valid instruction
     * 
     * @param string $str
     * @param const VALID_INSTRUCTION
     * @return boolean
     */
	function isValidInstruction(string $str, $validInstruction = VALID_INSTRUCTION) :bool
	{
		return in_array($str, $validInstruction);
	}

    /**
     * Return true if text is valid number
     * 
     * @param string $str
     * @return boolean
     */
	function isValidNumber($str) :bool
	{
		return is_numeric($str);
	}

	/**
     * Remove trail and convert multiple consecutive spaces into single space 
     * 
     * @param string $str
     * @return string
     */
	function removeDuplicateSpaces(string $str) :string
	{
		return trim(preg_replace('!\s+!', ' ', $str));
	}

	define('VALID_INSTRUCTION',
	[
		'add',
		'subtract',
		'minus',
		'divide',
		'multiply','apply'
	]);

	//Declare variables
	$initialValue = 0;
	$result;
	$instructions = [];
	$numbers = [];
	$filename = "instructions.txt";
	
	$debug = 1; //Debug is used to display additional messages when set to 1. 

	/*Allows user to specify the file they wish to read from by passing it as the second argument in command prompt.
	 When not stated, use default filename.*/
	if(isset($argv[1]))
	{
		$filename = $argv[1];
	}

	if($debug == 1) print "\n".$argv[1]."\n";
	
	if(is_readable($filename)) // Check if the file exists and is readable.
	{
		$myFile = fopen($filename,"r"); // Open for "reading only" and place the file pointer at the beginning of the file.
		
		if($debug == 1) print "\nContents of the file are : \n";

		while (!feof($myFile)) //Loops while file pointer has not reached end-of-file.
		{
			$line = fgets($myFile); // Get current line from file
			$line = removeDuplicateSpaces(strtolower($line));

            if($debug == 1) print 'line : '.$line."\n";

			if(count(explode(" ", $line)) < 2)
				continue;
				
			list($instruction, $number) = explode(" ", $line);

			//check valid instruction && valid number
			if((isValidInstruction($instruction)) && (isValidNumber($number)))
			{	
				if($instruction === 'apply'){
					//set initialValue && break out of loop
					$initialValue = $number;
					break;
				}
				else
				{
					//Add instruction to instructions && Add value to numbers
					 $instructions[] = $instruction;
					 $numbers[] =$number;
				}
			}
		}
		
		fclose($myFile); // The file pointed to by handle is closed.
        
        if($debug == 1){
            echo "\nOutput : \n";
            print_r($instructions);
            print_r($numbers);
            echo"\n";
        }

		$result = $initialValue;

		foreach($instructions as $key => $currentInstruction)
		{
			switch($currentInstruction){
				case "add":
					$result += $numbers[$key];
					break;
				case "subtract":
					$result -= $numbers[$key];
					break;
				case "multiply":
					$result *= $numbers[$key];
					break;
				case "divide":
					if($numbers[$key] !== 0)
						$result /= $numbers[$key];
					break;
				default:
					print "\n".$currentInstruction." is invalid command.\n";
			}
		}
		print "\nFinal Result is : " . $result."\n";
	}
	else // Output message if file is not readable.
	{
		print $filename." The file is not readable";
	}
?>
