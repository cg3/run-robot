<?php

include 'constants.php';

require_once 'model/Position.php';
require_once 'model/RunRobotGameBoard.php';
require_once 'model/RunRobotModel.php';
require_once 'model/AbstractRunRobotSolver.php';
require_once 'model/RunRobotBackTrackSolver.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * RunRobotSolver test case.
 */
class RunRobotSolverTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @var RunRobotSolver
	 */
	private $RunRobotSolver;
	private $model;
	
	private function initSolverWith($array)
	{
		$this->model = new RunRobotModel ( $array );
		$this->RunRobotSolver = new RunRobotBackTrackSolver ( $this->model );
	}
	
	protected function setUp() {
		parent::setUp ();
		$this->initSolverWith(array('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 4, 'FVboardY' => 4, 'FVterrainString' => '...X........X...' ));	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->RunRobotSolver = null;
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
	}
	
	/**
	 * Tests RunRobotSolver->__construct()
	 */
	public function test__construct() {
		$this->RunRobotSolver->__construct ( $this->model );
	}
	
	public function testRunTrue()
	{
	    $this->initSolverWith( array ('FVinsMin' => 3, 'FVinsMax' => 5, 'FVboardX' => 8, 'FVboardY' => 8, 'FVterrainString' => '....XX.X.........X..X........X.X........XX..X..X.XX.X.X......X..' ));
		$actual = $this->RunRobotSolver->canRobotRunThrough('RRRD');
		$expected = true;
		$this->assertEquals($expected, $actual);
	}
	
	public function testRunFalse()
	{
	    $this->initSolverWith( array ('FVinsMin' => 3, 'FVinsMax' => 5, 'FVboardX' => 8, 'FVboardY' => 8, 'FVterrainString' => '....XX.X.........X..X........X.X........XX..X..X.XX.X.X......X..' ));
		$actual = $this->RunRobotSolver->canRobotRunThrough('RRR');
		$expected = false;
		$this->assertEquals($expected, $actual);
	}
	
	public function testPositionAt()
	{
		$actual = $this->RunRobotSolver->positionAt('DRRDD');
		$expected = new Position(2, 3);
		$this->assertEquals($expected, $actual);
	}
	
	public function testTestStepD()
	{
		$this->initSolverWith( array ('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '.X.X' ));
		$actual = $this->RunRobotSolver->testStep(new Position(0, 0), 'D');
		$expected = true;
		$this->assertEquals($expected, $actual);
	}
	
    public function testTestStepR()
	{
		$this->initSolverWith( array ('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '..XX' ));
		$actual = $this->RunRobotSolver->testStep(new Position(0, 0), 'R');
		$expected = true;
		$this->assertEquals($expected, $actual);
	}
	
    public function testTestStepFalse()
	{
		$this->initSolverWith( array ('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '.XXX' ));
		$actual = $this->RunRobotSolver->testStep(new Position(0, 0), 'D');
		$expected = false;
		$this->assertEquals($expected, $actual);
	}
	
	public function testSolveWithStepLengthD() {
		$this->initSolverWith( array ('FVinsMin' => 1, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '.X..' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = 'D';
		$this->assertEquals($expected, $actual);
	}
	
    public function testSolveWithStepLengthR() {
		$this->initSolverWith( array ('FVinsMin' => 1, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '..X.' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = 'R';
		$this->assertEquals($expected, $actual);
	}
	
    public function testSolveWithStepLengthFalse() {
		$this->initSolverWith( array ('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '.XX.' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = false;
		$this->assertEquals($expected, $actual);
	}
	
    public function testSolveWithStepLengthDD() {
		$this->initSolverWith( array ('FVinsMin' => 2, 'FVinsMax' => 3, 'FVboardX' => 2, 'FVboardY' => 2, 'FVterrainString' => '.X.X' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = 'DD';
		$this->assertEquals($expected, $actual);
	}
	
    public function testSolveWithStepLength8False() {
		$this->initSolverWith( array ('FVinsMin' => 3, 'FVinsMax' => 3, 'FVboardX' => 8, 'FVboardY' => 8, 'FVterrainString' => '....XX.X.........X..X........X.X........XX..X..X.XX.X.X......X..' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = false;
		$this->assertEquals($expected, $actual);
	}	
	
    public function testSolveWithStepLength8Right() {
		$this->initSolverWith( array ('FVinsMin' => 3, 'FVinsMax' => 5, 'FVboardX' => 8, 'FVboardY' => 8, 'FVterrainString' => '....XX.X.........X..X........X.X........XX..X..X.XX.X.X......X..' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = 'RRRD';
		$this->assertEquals($expected, $actual);
	}
	
	public function test__ToString()
	{
	    $this->initSolverWith( array ('FVinsMin' => 3, 'FVinsMax' => 5, 'FVboardX' => 8, 'FVboardY' => 8, 'FVterrainString' => '....XX.X.........X..X........X.X........XX..X..X.XX.X.X......X..' ));
		$actual = $this->RunRobotSolver->__toString();
		$expected = 'RRRD';
		$this->assertEquals($expected, $actual);
	}
}

