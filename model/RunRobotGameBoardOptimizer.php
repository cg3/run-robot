<?php

require_once 'model/StringMerger.php';

class RunRobotGameBoardOptimizer
{
    public $gameBoard;
    private $gameBoardStrings;

    public function __construct(RunRobotGameBoard $gameBoard)
    {
        $this->gameBoard = $gameBoard;
    }

    public function optimize()
    {
        $this->buildGameBoardAsStrings();
        $this->optimizeLines();
        $this->copyStringsToGameBoard();
        $this->transponiere();
        $this->buildGameBoardAsStrings();
        $this->optimizeLines();
        $this->copyStringsToGameBoard();
        $this->transponiere();
        return $this->gameBoard;
    }

    private function buildGameBoardAsStrings()
    {
        $this->gameBoardStrings = array();
        $oldLine = str_repeat('X', $this->gameBoard->xSize);
        foreach($this->gameBoard->gameBoard as $lineArray)
        {
            $newLine = implode('',$lineArray);
            $this->gameBoardStrings[] = StringMerger::mergeStrings($newLine, $oldLine);
            $oldLine = $newLine;
        }
    }

    private function optimizeLines()
    {
        $oldLine = str_repeat('X', $this->gameBoard->xSize);
        for($actLine = 0; $actLine < $this->gameBoard->xSize; $actLine++)
        {
            $mergedLine = StringMerger::mergeStrings($this->gameBoardStrings[$actLine], $oldLine);
            $this->gameBoardStrings[$actLine] = $this->optimizeLine($mergedLine);
            $oldLine = $this->gameBoardStrings[$actLine];
        }
    }

    public function optimizeLine($optimizedString)
    {
        while($this->existsOptimization($optimizedString) !== false)
        {
            $optimizedString = $this->optimizeFrom($optimizedString, $this->existsOptimization($optimizedString));
        }
        return str_replace('+','.', $optimizedString);
    }

    public function existsOptimization($str)
    {
        $match = '/X\++X/';
        $result = $this->matchPosition($match, $str);
        if($result !== false)
            return $result;
        
        $match = '/X\++$/';
        return $this->matchPosition($match, $str);
    }

    private function matchPosition($match, $str)
    {
        $res = preg_match($match, $str, $treffer, PREG_OFFSET_CAPTURE);
        if($res == 0)
            return false;
        
        return $treffer[0][1];
    }

    public function optimizeFrom($str, $offset)
    {        
        $len = strlen($str);
        do{
            $str[$offset] = 'X';
            $offset++;
        }while(($offset < $len) && ($str[$offset] == '+'));
        return $str;
    }

    private function copyStringsToGameBoard()
    {
        $this->gameBoard = new RunRobotGameBoard($this->gameBoard->xSize, $this->gameBoard->xSize, implode('',$this->gameBoardStrings));
    }

    public function transponiere()
    {
        $result = array();
        for($y = 0; $y < $this->gameBoard->ySize; $y++)
        {
            for($x = 0; $x < $this->gameBoard->xSize; $x++)
            {
                $result[$y][$x] = $this->gameBoard->gameBoard[$x][$y];
            }
        }
        $this->gameBoard->gameBoard = $result;
    }

}
