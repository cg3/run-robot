<?php

include 'constants.php';

require_once 'model/StringMerger.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * RunRobotSolver test case.
 */
class RunRobotSolverTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var RunRobotSolver
	 */
	
	private function initSolverWith($array)
	{}
	
        protected function setUp() 
        {
		parent::setUp ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
	}
    public function testSimpleString()
    {
        $base = '..XX';
        $merg = '.X.X';
        $actual = StringMerger::mergeStrings($base, $merg);
        $expected = '.+XX';
        $this->assertEquals($expected, $actual);
    }

    public function testEmptyMerge()
    {
        $base = '..XX';
        $merg = '';
        $actual = StringMerger::mergeStrings($base, $merg);
        $expected = $base;
        $this->assertEquals($expected, $actual);
    }
}

