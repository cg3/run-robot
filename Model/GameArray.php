<?php

class GameArray {
    private $gameArray;

    public function __construct($array) {
        $this->gameArray = $array;
    }

    public function Terrain() {
        return $this->CheckArray('FVterrainString');
    }

    private function CheckArray($arrayKey) {
        if(array_key_exists($arrayKey, $this->gameArray)) {
            return $this->gameArray[$arrayKey];
        }

        throw new KeyNotFoundException();
    }

    public function MinSteps() {
        return $this->CheckArray('FVinsMin');
    }

    public function MaxSteps() {
        return $this->CheckArray('FVinsMax');
    }


    public function Level() {
        return $this->CheckArray('FVlevel');
    }
}

class KeyNotfoundException extends Exception {}
