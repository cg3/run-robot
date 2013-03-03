<?php

abstract class AbstractRunRobotSolver {
	/* @var $model RunRobotModel */
	protected $model;
	
	public function __construct(RunRobotModel $model)
	{
		$this->model = $model;
	}
	
	public function __toString()
	{
		return $this->findeLoesung();
	}
	
	protected abstract function findeLoesung();
	
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

?>
