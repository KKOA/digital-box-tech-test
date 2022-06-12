<?php 
declare(strict_types =1);
require_once("functions.php");
require_once("FileInstructionReader.php");
require_once("Calc.php");

/**
 * Created by : PhpStorm.
 * Description : Read information from another file. Depending on this information read output appropriate results.
 * User : keith
 * Date : 04/06/2022
 */

//Declare variables
$debug = false; //Debug is used to display additional messages when set to true.

//second argument allows the user to specify a filename (mandatory)
if(!isset($argv[1])){
    print "No file specified";
    die();
}

$filename = $argv[1];

if(!is_readable($filename)){ // Check if the file exists and is readable.
    print $filename." The file is not readable";
    die();
}

// third argument specify whether to enable debug mode or not (optional)
// If omitted debug is false
if(isset($argv[2]))
{
    $debug = (bool)$argv[2];
}

if(debugMode($debug)) print "\n".$argv[1]."\n";

$textInstructionReader = new FileInstructionReader($filename,$debug);
list($initialValue,$instructions,$numbers) = $textInstructionReader->getInstructions();

print "\nInitial Value is : " . $initialValue."\n\n";

//$result = executeInstructions($initialValue,$instructions,$numbers);
$calc = new Calc($initialValue,$debug);
$result = $calc->executeInstructions($instructions,$numbers);

print "Final Result is : " . $result."\n\n";
