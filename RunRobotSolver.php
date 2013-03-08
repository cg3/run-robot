<?php

class RunRobotSolver {
    private $loader;
    private $solver;
    private $responder;

    public function __construct(Loader $loader, Solver $solver, Responder $responder){
        $this->loader = $loader;
        $this->solver = $solver;
        $this->responder = $responder;
    }

    public function solve(){
        $gameArray = $this->loader->load();
        $solution = $this->solver->solve($gameArray);
        $this->responder->answer($solution);
    }
}
