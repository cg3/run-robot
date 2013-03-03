<?php

include_once 'constants.php';

class RunRobotGameBoard
{
    public $gameBoard;
    public $xSize;
    
    public function __construct($xSize, $valueString)
    {
        for($y = 0; $y < $xSize; $y++)
        {
            for($x = 0; $x < $xSize; $x++)
            {
                $this->gameBoard[$y][$x] = $valueString[$y*$xSize + $x];
            }
        }
        
        $this->xSize = $xSize;
    }
    
    public function printOut()
    {
        foreach ($this->gameBoard as $column) {
            echo implode('', $column)."\n";
        }
    }
    
    public function __toString()
    {
        $result = "";
        foreach ($this->gameBoard as $column) {
            $result .= implode('', $column);
        }
        return $result;
    }
    
    public function field($x, $y)
    {
    	if(!$this->positionOnGameBoard($x, $y))
    		throw new Exception('Index out of bounds.');

        return $this->gameBoard[$y][$x];
    }
    
    public function isMine($x, $y)
    {
    	if(!$this->positionOnGameBoard($x, $y))
            return false;
        return $this->mineField($x, $y);
    }

    private function mineField($x, $y)
    {
    	return ($this->field($x, $y) == MINE_FIELD);
    }

    public function endPointEmpty($x, $y)
    {
        $testX = $x-1;
        $testY = $y-1;
        while($this->positionOnGameBoard($testX, $testY))
        {
            if($this->mineField($testX, $testY))
            {
                return false;
            }
            $testX += $x;
            $testY += $y;
        }
        return true;
    }

    public function positionOnGameBoard($x, $y)
    {
    	return $x < $this->xSize && $y < $this->xSize && $x >= 0 && $y >= 0;
    }
    
    public function optimize()
    {
        $this->optimizeColumns();
	$this->transponiere();
	$this->optimizeColumns();
	$this->transponiere();
	$this->fillBlockedGaps();
    }
    
    public function fillBlockedGaps()
    {
        for($y = $this->xSize - 1; $y >= 0 ; $y--)
        {
            for($x = $this->xSize - 1; $x >= 0; $x--)
            {
                if($this->isBlocked($x, $y))
                    $this->setMark($x, $y);
            }
        }
    }
    
    private function optimizeColumns()
    {
        for ($i = 0; $i< count($this->gameBoard);$i++) {
            $this->optimizeColumn($i);
        }
    }

    public function optimizeColumn($lineNumber)
    {
        $lineToString = implode('',$this->gameBoard[$lineNumber]);
        $startPosition = $this->fromMark($lineToString);
        while(true)
        {
            $endPosition = $this->toMark($lineToString, $startPosition);
            if($this->lineBlocked($lineNumber,$startPosition,$endPosition))
            {
                for($actPosition = $startPosition + 1; $actPosition <= $endPosition; $actPosition++)
                {
                    $this->setMark($actPosition, $lineNumber);
                }
                $lineToString = implode('',$this->gameBoard[$lineNumber]);
            }
            $newpos = $this->fromMark($lineToString, $startPosition+1);
            if($newpos <= $startPosition)
                return;
            $startPosition = $newpos;
        }
    }

    public function lineBlocked($line, $startPos, $endPos)
    {
        if($line == 0)
		return true;

	if($endPos < $startPos + 2)
		return false;

        return substr_count(implode('',$this->gameBoard[$line-1]), EMPTY_FIELD, $startPos+1, $endPos-1-$startPos) == 0;
    }

    
    public function fromMark($str, $offset = 0)
    {
        $result =  strpos($str, MINE_FIELD . EMPTY_FIELD, $offset);
        if($result === false)
            return strlen($str)-1;
        return $result;            
    }
    
    public function toMark($str, $fromMark)
    {
        $pos = strpos($str, EMPTY_FIELD . MINE_FIELD, $fromMark);
        if($pos === false)
            return strlen($str) - 1;
            
        return $pos+1;
    }
    
    public function setMark($x, $y)
    {
        $this->gameBoard[$y][$x] = MINE_FIELD;
    }
    
    public function transponiere()
    {
        $result = array();
        for($y = 0; $y < $this->xSize; $y++)
        {
            for($x = 0; $x < $this->xSize; $x++)
            {
                $result[$y][$x] = $this->gameBoard[$x][$y];
            }
        }
        $this->gameBoard = $result;
    }
    
    private function isBlocked($x, $y)
    {
        if($x == $this->xSize-1 || $y == $this->xSize-1)
            return false;
        
        return ($this->field($x+1, $y) == MINE_FIELD && $this->field($x, $y+1) == MINE_FIELD); 
    }

	public function fold($xVector, $yVector)
	{
		$x = $xVector;
		$y = $yVector;
		while($x < $this->xSize && $y < $this->xSize)
		{
			$this->singleFold($x, $y);
			$x+=$xVector;
			$y+=$yVector;
		}
	}

	private function singleFold($xVector, $yVector)
	{
		for($x = $xVector;$x < $this->xSize; $x++)
		{
			for($y=$yVector;$y<$this->xSize; $y++)
			{
				if($this->isMine($x, $y))
					$this->setMark($x-$xVector, $y-$yVector);
			}
		}
	}
}
