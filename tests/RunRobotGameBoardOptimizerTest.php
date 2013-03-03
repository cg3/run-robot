<?php

require_once 'model/RunRobotGameBoard.php';
require_once 'model/RunRobotGameBoardOptimizer.php';
require_once 'model/Position.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * RunRobotGameBoard test case.
 */
class RunRobotGameBoardOptimizerTest extends PHPUnit_Framework_TestCase {
        
    private $optimizer;
        
    protected function setUp() 
    {
        parent::setUp ();
    }
        
    protected function tearDown()
    {
        $this->optimizer = null;
        parent::tearDown();
    }
        
    public function __construct()
    { }

    public function reinitOptimizer($x, $y, $str)
    {
        $gameBoard = new RunRobotGameBoard($x, $y, $str);
        $this->optimizer = new RunRobotGameBoardOptimizer($gameBoard);
    }

    public function test_ExistsOptimizationTrue()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = 3;
        $actual = $this->optimizer->existsOptimization('...X++X');
        $this->assertEquals($expected, $actual);
    }

    public function test_ExistsOptimizationTrueDoubleX()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = 3;
        $actual = $this->optimizer->existsOptimization('..XX++X');
        $this->assertEquals($expected, $actual);
    }

    public function test_ExistsOptimizationFalse()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = false;
        $actual = $this->optimizer->existsOptimization('...X++.');
        $this->assertEquals($expected, $actual);
    }

    public function test_ExistsOptimizationEndTrue()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = 3;
        $actual = $this->optimizer->existsOptimization('...X+++');
        $this->assertEquals($expected, $actual);
    }

    public function test_OptimizeLineSimpleMiddle()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = '..XXX.';
        $actual = $this->optimizer->optimizeLine('..X+X.');
        $this->assertEquals($expected, $actual);
    }

    public function test_OptimizeLineDoubleMiddle()
    {
        $this->reinitOptimizer(6,2,'..X...XXXXXX');
        $expected = '..XXXXX.';
        $actual = $this->optimizer->optimizeLine('..X+X+X.');
        $this->assertEquals($expected, $actual);
    }

    public function testMiddleLineWithEnding() 
    {
        $this->reinitOptimizer(6,3,'XXXXXX.X...X......');
        $optimizedGameBoard = $this->optimizer->optimize();
        $expected = 'XXXXXX.XXXXX......';
        $actual = $this->optimizer->gameBoard->__toString();
        $this->assertEquals($expected, $actual);
    }

    public function testMiddleAndEndLineWithEnding() 
    {
        $this->reinitOptimizer(6,3,'XXXXXX.X...X..X.X.');
        $optimizedGameBoard = $this->optimizer->optimize();
        $expected = 'XXXXXX.XXXXX..XXXX';
        $actual = $this->optimizer->gameBoard->__toString();
        $this->assertEquals($expected, $actual);
    }

    public function testWithoutEnding() 
    {
        $this->reinitOptimizer(6,3,'XXXXXX.X......X.X.');
        $optimizedGameBoard = $this->optimizer->optimize();
        $expected = 'XXXXXX.XXXXX..XXXX';
        $actual = $this->optimizer->gameBoard->__toString();
        $this->assertEquals($expected, $actual);
    }
}


