<?php

class RunRobotModel
{
    public $minSteps;
    public $maxSteps;
    public $gameBoard;
    
    public function __construct($gameArray)
    {
        $this->minSteps = $gameArray['FVinsMin'];
        $this->maxSteps = $gameArray['FVinsMax'];
        $this->gameBoard = new RunRobotGameBoard($gameArray['FVboardX'], 
                $gameArray['FVboardY'], $gameArray['FVterrainString']);
    }

    public function __clone()
    {
	    $this->gameBoard = clone $this->gameBoard;
    }
}

