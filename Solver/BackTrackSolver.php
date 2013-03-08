<?php

class BackTrackSolver implements Solver {

    public function solve(GameArray $gameArray) {
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
	
	public function canRobotRunThrough($cmd)
	{
            $x = 0;
            $y = 0;
	    $cmdPos = 0;
            while ($this->model->gameBoard->positionOnGameBoard($x, $y))
		{
			if ($cmd[$cmdPos++] == STEP_RIGHT)
				$x++;
			else
				$y++;
			if ($cmdPos == strlen($cmd))
				$cmdPos = 0;
			if ($this->model->gameBoard->isMine($x, $y))
				return false;
		}
		return true;
	} 
}
