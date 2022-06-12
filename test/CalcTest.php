<?php
/**
 * Created by : PhpStorm.
 * User : keith
 * Date : 12/06/2022
 */
declare(strict_types=1);


use \PHPUnit\Framework\TestCase;

require_once('Calc.php');
require_once('functions.php');

/**
 * Class CalcTest
 */
class CalcTest extends TestCase
{

	/**
	 * @return array[]
	 */
	public function single_instruction(){
		return [
			[['add'],[5],6.0],
			[['add'],[5.5],6.5],

			[['subtract'],[5],-4.0],
			[['subtract'],[3.2],-2.2],

			[['multiply'],[5],5.0],
			[['multiply'],[5.7],5.7],

			[['divide'],[5],0.2],
			[['divide'],[0],1.0],
			[['divide'],[2],0.5],
			[['command'],[10],1.0], // Invalid command
			[['divide','multiply','subtract','add'],[2,5.7,2,3],3.85] //Multiple commands
		];
	}
	/**
	 * @test
	 * @dataProvider single_instruction
	 */
	public function When_provided_single_instruction_to_executeInstruction_returns_correct_value($instructions,$numbers,$expectedValue) :void
	{

		$debug = false;
		$initialValue = 1.0;
		$sut = new Calc($initialValue,$debug);
		$result = $sut->executeInstructions($instructions,$numbers);
		$this->assertEquals($expectedValue,$result);
	}

	/**
	 * @return array[]
	 */
	public function multiple_instructions(){
		return [
			[['divide','multiply','subtract','add'],[2,5.7,2,3],3.85]
		];
	}


	/**
	 * @test
	 * @dataProvider multiple_instructions
	 */
	public function When_provided_multiple_instructions_to_executeInstruction_returns_correct_value($instructions,$numbers,$expectedValue) :void
	{

		$debug = false;
		$initialValue = 1.0;
		$sut= new Calc($initialValue,$debug);
		$result = $sut->executeInstructions($instructions,$numbers);
		$this->assertEquals($expectedValue,$result);
	}
}