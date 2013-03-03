<?php
require_once 'PHPUnit/Extensions/OutputTestCase.php';
require_once 'Loader/Loader.php';
require_once 'Solver/Solver.php';
require_once 'Responder/Responder.php';
require_once 'RunRobotSolver.php';

class RunRobotSolverTest extends PHPUnit_Extensions_OutputTestCase {
    
    private $loader;
    private $solver;
    private $responder;

    public function setUp() {
        parent::setUp ();
        $this->loader = new MockLoader();
        $this->solver = new MockSolver();
        $this->responder = new MockResponder();
    }

    public function testCreate() {        
        $solver = new RunRobotSolver($this->loader, $this->solver, $this->responder);
    }

    public function testSolve() {
        $this->expectOutputString(MockResponder::$ANSWER);
        $solver = new RunRobotSolver($this->loader, $this->solver, $this->responder);
        $solver->solve();
    }
}

class MockLoader implements Loader {
    
    public function load() {
        return new GameArray(array());
    }
}

class MockSolver implements Solver {
    
    public function solve(GameArray $gameArray) {
    }
}

class MockResponder implements Responder {
    
    public static $ANSWER = 'Solution.';

    public function answer($solution) {
        echo self::$ANSWER;
    }
}
