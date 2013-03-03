<?php

class RunRobotArrayMoveSolver extends AbstractRunRobotSolver 
{
    protected function findeLoesung()
    {
        $map = new PathMap($this->model->gameBoard);
    }
}
