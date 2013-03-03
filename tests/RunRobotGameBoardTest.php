<?php

require_once 'model/RunRobotGameBoard.php';
require_once 'model/Position.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * RunRobotGameBoard test case.
 */
class RunRobotGameBoardTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var RunRobotGameBoard
	 */
	private $RunRobotGameBoard;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		$this->RunRobotGameBoard = new RunRobotGameBoard(2,2,'.X.X');
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->RunRobotGameBoard = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
	}

	public function testIsMineOk() {
		$actual = $this->RunRobotGameBoard->isMine(0,1);
		$expected = false;
		$this->assertEquals($expected, $actual);
	}
	
	public function testIsMineBad() {
		$actual = $this->RunRobotGameBoard->isMine(1,1);
		$expected = true;
		$this->assertEquals($expected, $actual);
	}
	
	public function testPositionOnGameBoardOk() {
		$actual = $this->RunRobotGameBoard->positionOnGameBoard(1, 0);
		$expected = true;
		$this->assertEquals($expected, $actual);
	}
	
	public function testPositionOnGameBoard() {
		$actual = $this->RunRobotGameBoard->positionOnGameBoard(1, 2);
		$expected = false;
		$this->assertEquals($expected, $actual);
	}

	public function testFromMarkOk()
	{
	    $actual = $this->RunRobotGameBoard->fromMark('...XX.X..X.XX.');
	    $expected = 4;
		$this->assertEquals($expected, $actual);
	}
	
	public function testFromMarkFalse()
        {
            $lineStr = '...XXXXXXXXXXX';
	    $actual = $this->RunRobotGameBoard->fromMark($lineStr);
	    $expected = strlen($lineStr) - 1;
		$this->assertEquals($expected, $actual);
	}
	
	public function testToMark()
	{
	    $actual = $this->RunRobotGameBoard->toMark('...XX.X..X.XX.', 6);
	    $expected = 9;
		$this->assertEquals($expected, $actual);
	}
	
    public function testToMarkEnd()
	{
	    $actual = $this->RunRobotGameBoard->toMark('...XX.X..X....', 9);
	    $expected = 13;
		$this->assertEquals($expected, $actual);
	}
	
	public function testlineBlocked()
	{
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.X..X...............................');
	    $actual = $this->RunRobotGameBoard->lineBlocked(0, 1, 4);
	    $expected = true;
		$this->assertEquals($expected, $actual);
	}
	
    public function testlineBlockedLine0()
	{
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.X..X...............................');
	    $actual = $this->RunRobotGameBoard->lineBlocked(0, 1, 10);
	    $expected = true;
		$this->assertEquals($expected, $actual);
	}
	
    public function testlineBlockedLine1Ok()
	{
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XXXXX..X..X........................');
	    $actual = $this->RunRobotGameBoard->lineBlocked(1, 2, 5);
	    $expected = true;
		$this->assertEquals($expected, $actual);
	}
	
    public function testlineBlockedLine1False()
	{
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XXXXX..X..X........................');
	    $actual = $this->RunRobotGameBoard->lineBlocked(2, 2, 5);
	    $expected = false;
		$this->assertEquals($expected, $actual);
	}
	
    public function testOptimizeColumn()
    {
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XX..X..X..X........................');
	    $this->RunRobotGameBoard->optimizeColumn(0);
	    $actual = $this->RunRobotGameBoard->__toString();
	    $expected = '.XXXXX..X..X........................';
		$this->assertEquals($expected, $actual);
    }

    public function testEndPointIsEmpty()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'XXXXXXX.X..XXXXXXX............XXXXX.');
        $this->RunRobotGameBoard->fold(2,2);
	$actual = $this->RunRobotGameBoard->endPointEmpty(2,2);
	$expected = true;
        $this->assertEquals($expected, $actual);
    }
	
    public function testEndPointIsNotEmpty()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XX..X..X..X.......................X');
	$actual = $this->RunRobotGameBoard->endPointEmpty(2,2);
	$expected = false;
        $this->assertEquals($expected, $actual);
    }

    public function testOptimizeColumn1()
    {
	    $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XX..X..X..X........................');
	    $this->RunRobotGameBoard->optimizeColumn(1);
	    $actual = $this->RunRobotGameBoard->__toString();
	    $expected = '.XX..X..X..X........................';
		$this->assertEquals($expected, $actual);
    }
	
    public function testOptimizeColumn2()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'.XXXXX...XXXX..X.X..................');
        $this->RunRobotGameBoard->optimizeColumn(2);
        $actual = $this->RunRobotGameBoard->__toString();
        $expected = '.XXXXX...XXXX..XXX..................';
        $this->assertEquals($expected, $actual);
    }


    public function testOptimizeColumnErrorCase()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..XXXX....X.X..XXX.X...X..X.X.X.....');
        $this->RunRobotGameBoard->optimizeColumn(5);
        $actual = $this->RunRobotGameBoard->__toString();
        $expected = '..XXXX....X.X..XXX.X...X..X.X.X.....';
        $this->assertEquals($expected, $actual);
    }

    public function testOptimize()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..X.......X.X..X.X.X...X..X.X.X.....');
        $this->RunRobotGameBoard->optimize();
        $actual = $this->RunRobotGameBoard->__toString();
        $expected = '..XXXX...XXXX..XXXXX..XXXXX.XXXXX...';
        $this->assertEquals($expected, $actual);
    }

    public function testOptimizeErrorCase()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..X..X...X..X...X.X.X...XXX.X.X.XX..');
        $this->RunRobotGameBoard->optimize();
        $actual = $this->RunRobotGameBoard->__toString();
        $expected = '..XXXX...XXXX...X.XXX...XXXXX.XXXX..';
        $this->assertEquals($expected, $actual);
    }

    public function testOptimizeOverheadBlock()
    {
        $this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..........X....X.X..................');
        $this->RunRobotGameBoard->optimize();
        $actual = $this->RunRobotGameBoard->__toString();
        $expected = '.........XX....XXX..................';
        $this->assertEquals($expected, $actual);
    }

	public function testFoldSimple()
	{
		$this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..................XXX.XX..X.XX.XXXXX');
		$this->RunRobotGameBoard->fold(3,3);
		$actual = $this->RunRobotGameBoard->__toString();
		$expected = '.XX....XX...XXX...XXX.XX..X.XX.XXXXX';
		$this->assertEquals($expected, $actual);
	}

	public function testFoldComplex()
	{
		$this->RunRobotGameBoard = new RunRobotGameBoard(6,6,'..............X......X.......X....X.');
		$this->RunRobotGameBoard->fold(2,2);
		$actual = $this->RunRobotGameBoard->__toString();
		$expected = 'XX....XX......XX....XX.......X....X.';
		$this->assertEquals($expected, $actual);
	}
}

