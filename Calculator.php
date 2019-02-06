<?php
/* 
Description : Read information from another file. Depending on this information read output appropriate results.
Author : Keith Amoah
Date : 04/01/2016
*/



	//Declare variables
	$initialValue;
	$result;
	$instructions = [];
	$numbers = [];
	$filename = "instructions.txt";
	$applyFound = false;
	
	$debug = 0; //Debug is used to display additional messages when set to 1. 
	$counter = 0;
	
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
			$line = fgets($myFile); // Get current line from file.
			
			if($debug == 1) print $line;
			
			// $tempInstruction & $tempNumber are temporary arrays which are overwritten each time this loops is executed.
			if(preg_match("/\b[a-zA-Z]{3,8}\b/", $line))// Matches any character in the range a-z & A - Z between 3 and 8 characters long.
			{
				preg_match("/\b[a-zA-Z]{3,8}\b/", $line, $tempInstruction);
			}
			else
			{
				$tempInstruction[0] =" ";
			}
			if($debug == 1) print "\nCurrent Instruction is: ".$tempInstruction[0]."\n";
			
			
			if(preg_match("/\d+\.?\d{0,1}/", $line))// Matches any whole number. The number may have up to 2 decimal places.
			{
				preg_match("/\d+\.?\d{0,1}/", $line, $tempNumber);
			}
			else
			{
				$tempNumber[0] =" ";
			}
			
			
			if($debug == 1) print "\nCurrent Number is  : ".$tempNumber[0]."\n";
			
			//Add values to instructions & numbers arrays.
			array_push($instructions,$tempInstruction[0]);
			array_push($numbers,$tempNumber[0]);	
			
			if(stripos($tempInstruction[0], "apply")!==false)
			{
				break; 
			}
			/* 
			Break out of loop if "apply" is found.
			This is case insensitive. It prevents reading of empty newline or appropriate text after the apply instruction line. 
			*/
		}
		
		fclose($myFile); // The file pointed to by handle is closed.
		
		for($i = 0; $i < count($instructions); $i++)// Loop through instructions for word "apply".
		{
			if(stripos($instructions[$i], "apply")!==false)
			{
				$applyFound = true; //Set to true if "apply" instruction was found.
				break;
			}
		}	
		
		if($applyFound =="true") // Depending on the result, either perform calculations or output message to screen.
		{
		
			if(is_numeric($numbers[count($numbers)-1])) // Check if an initial value has been set.
			{
				$result = $numbers[count($numbers)-1]; // Set initial value.
			}
			else // Set initial value to 0 if not set .
			{
				print "\nNo initial value has been set. Initial value has been set to 0.\n";
				$result = 0;
			}
			
			
			if($debug == 1)print "\n\nThe initial value is : " . $result."\n";	
		
			if($debug == 1) print "\nstart of Loop\n\n";
			while($counter < count($instructions) - 1)
			{
				// Execute different operation depending on the instruction in the file.
				if(!is_numeric($numbers[$counter]))// Instruction is not executed if there is no corresponding number
				{
					print "\nNo corresponding number to instruction. Instruction is skipped.\n";
					
				}
				else if(stripos($instructions[$counter], "add") !== false) // Allow read instruction regardless of case.
				{
					if($debug == 1) print $instructions[$counter]." ".$numbers[$counter];
					$result = $result + $numbers[$counter];
				}
				else if(stripos($instructions[$counter], "multiply") !== false)
				{
					if($debug == 1) print $instructions[$counter]." ".$numbers[$counter];
					$result = $result * $numbers[$counter];
				}
				else if(stripos($instructions[$counter], "subtract") !== false)
				{
					if($debug == 1) print $instructions[$counter]." ".$numbers[$counter];
					$result = $result - $numbers[$counter];
				}
				else if(stripos($instructions[$counter], "divide") !== false)
				{
					if($debug == 1) print $instructions[$counter]." ".$numbers[$counter];
					
					if( $numbers[$counter] != 0) // Check if divisor is 0. This instruction is ignored if true.
					{
						$result = $result / $numbers[$counter];
					}
					else
					{
						print "Cannot divide by 0, instruction not executed";
					}
				}
				else // Output invalid instruction message if the instruction does not match the above binary operators.
				{
					print "\n".$instructions[$counter]." is invalid command.\n";
				}
				if($debug == 1)print "new result : " . $result."\n\n";
				$counter++; // Increment counter
		
			}
			if($debug == 1)print "\nend of Loop\n";
			print "\nFinal Result is : " . $result."\n";
			
		}
		else
		{
			print "\nNo Apply instruction found. Application stopped. \n";
		}
		
	}
	else // Output message if file is not readable.
	{
		print $filename." The file is not readable";
	}
	
	

?>
