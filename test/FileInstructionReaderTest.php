<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 05/06/2022
 */
declare(strict_types=1);

use \PHPUnit\Framework\TestCase;

require_once('FileInstructionReader.php');
require_once('functions.php');

/**
 * Class FileInstructionReaderTest
 */
class FileInstructionReaderTest extends TestCase
{

	/**
	 * @test
	 */
	public function when_file_provide_is_empty_return_default_response() :void{
		$sut = new FileInstructionReader('test/inputFiles/empty.txt',false);
		$result =$sut->getInstructions();
		$this->assertEquals([0,[],[]],$result);
	}

	/**
	 * @test
	 */
	public function when_file_provide_contain_empty_lines_return_default_response() :void{
		$sut = new FileInstructionReader('test/inputFiles/emptyLines.txt',false);
		$result =$sut->getInstructions();
		$this->assertEquals([0,[],[]],$result);
	}

	function invalidLineFiles(){
		return [
			['invalidLine.txt',[0,[],[]]],
			['invalidLine2.txt',[0,[],[]]],
			['invalidLine3.txt',[0,[],[]]]
		];
	}

	/**
	 * @test
	 * @dataProvider invalidLineFiles
	 */
	public function when_file_provide_contain_invalid_line_return_default_response($file,$expectation):void{
		$sut = new FileInstructionReader("test/inputFiles/$file",false);
		$result =$sut->getInstructions();
		$this->assertEquals($expectation,$result);
	}

	function validLines(){
		return [
			['add.txt', [0,['add'],[5]]],
			['subtract.txt', [0,['subtract'],[5]]],
			['multiply.txt', [0,['multiply'],[5]]],
			['divide.txt', [0,['divide'],[5]]],
			['apply.txt', [5,[],[]]]
		];
	}

	/**
	 * @test
	 * @dataProvider validLines
	 */
	public function when_file_provide_contain_valid_line_return_correct_response($file,$expectation):void{

		$sut = new FileInstructionReader("test/inputFiles/$file",false);
		$result =$sut->getInstructions();
		$this->assertEquals($expectation,$result);
	}

	function multiValidLines(){
		return [
			['multi.txt', [8,['add','divide','multiply','subtract'],[2,5,3,1]]],
			['multi2.txt', [0,['add','divide','multiply','subtract'],[2.5,5,3,1]]]
		];
	}

	/**
	 * @test
	 * @dataProvider multiValidLines
	 */
	public function when_file_provide_contains_mutliple_return_correct_response($file,$expectation):void{
		$sut = new FileInstructionReader("test/inputFiles/$file",false);
		$result =$sut->getInstructions();
		$this->assertEquals($expectation,$result);
	}


//	/**
//	 * @test
//	 */
//	public function getInstructions_returns_no_instructions_when_file_is_empty() :void
//	{
//		$sut = new FileInstructionReader('test/empty.txt',false);
//		$result=$sut->getInstructions();
//
//		$this->assertEquals([0,[],[]],$result);
//
//	}
//
//	/**
//	 * @test
//	 */
//	public function getInstructions_returns_no_instructions_when_file_contains_invalid_instructions() :void{
//		$sut = new FileInstructionReader('test/invalidInstructions.txt',false);
//		$result=$sut->getInstructions();
//
//		$this->assertEquals([0,[],[]],$result);
//	}
//
//	/**
//	 * @test
//	 */
//	public function getInstructions_returns_no_instructions_when_file_contains_invalid_numbers() :void{
//		$sut = new FileInstructionReader('test/invalidNumbers.txt',false);
//		$result=$sut->getInstructions();
//
//		$this->assertEquals([0,[],[]],$result);
//	}
//
//	/*
//	 * @test
//	 * @data
//	 */
//	public function getInstructions_returns_no_instructions_when_file_contains_invalid_numbers(){
//
//	}
}