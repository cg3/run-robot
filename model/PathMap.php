<?php

class PathMap
{
    public function __construct($gameBoard)
    {        
        $this->map = GameBoardToPathMapConverter($gameBoard);
    }

}
