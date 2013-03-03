<?php

class GameBoardToPathMapConverter
{
    public static function convertToMap($gameBoard)
    {
        $map = array();
        for($x = 0; $x < $gameBoard->xSize-1; $x++)
        {
            for($y = 0; $y < $gameBoard->ySize-1; $y++)
            {
                $down = $gameBoard[$y+1][$x] == '.' : 1 : 0;
                $rigth = $gameBoard[$y][$x+1] == '.' : 2 : 0;

                $map[$y][$x] = $down + $right;
            }
        }
    }
}
