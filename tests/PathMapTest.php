<?php

include 'constants.php';

require_once 'model/PathMap.php';
require_once 'model/RunRobotGameBoard.php';

require_once 'PHPUnit/Framework/TestCase.php';

class PathMapTest extends PHPUnit_Framework_TestCase 
{
    private $gameBoard;
    private $map;

    protected function setUp() 
    {
        parent::setUp ();
        $this->gameBoard = new RunRobotGameBoard(5, 5, '');
    }
	
    protected function tearDown()
    {
        parent::tearDown ();
    }
	
    public function __construct()
    {
    }

    public function testCreateSimpleMap()
    {
        $pathMap = new PathMap($this->gameBoard);
        $actual = $pathMap->createMap($this->gameBoard);
        $expected = array($this->map);
        $this->assertEquals($expected, $actual);
    }
}

