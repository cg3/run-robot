<?php

class RunRobotBackTrackSolver extends AbstractRunRobotSolver
{
    protected function findeLoesung ()
    {
        if($this->model->gameBoard->isMine(0,0))
            return false;

        return $this->findeBackTrackLoesung();
    }

    protected function findeBackTrackLoesung ($vektor = '')
    {
        if (strlen($vektor) > $this->model->maxSteps) {
            return false;
        }
        if (strlen($vektor) >= $this->model->minSteps) {
            if ($this->canRobotRunThrough($vektor)) {
                return $vektor;
            }
        }
        $pos = $this->positionAt($vektor);
        $result = false;
        if ($this->testStep($pos->x, $pos->y, STEP_RIGHT)) {
            $result = $this->findeBackTrackLoesung($vektor . STEP_RIGHT);
            if ($result) {
                return $result;
            }
        }
        if ($this->testStep($pos->x, $pos->y, STEP_DOWN)) {
            $result = $this->findeBackTrackLoesung($vektor . STEP_DOWN);
        }
        return $result;
    }

    public function positionAt ($cmd)
    {
        $x = substr_count($cmd, STEP_RIGHT);
        $y = strlen($cmd) - $x;
        return new Position($x, $y);
    }

    public function testStep ($x, $y, $direction)
    {
        $gameBoard = $this->model->gameBoard;
        if ($direction == STEP_RIGHT) {
            $xdiff = 1;
            $ydiff = 0;
        } else {
            $xdiff = 0;
            $ydiff = 1;
        }
        try {
            if ($gameBoard->isMine($x + $xdiff, $y + $ydiff)) {
                return false;
            }
        } catch (Exception $e) {}
        return true;
    }
}
