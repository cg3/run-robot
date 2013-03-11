<?php

class GameArray {
    private $gameArray;

    public function __construct($array) {
        $this->gameArray = $array;
    }

    public function Terrain() {
        return $this->ReturnIfKeyExists('FVterrainString');
    }

    private function ReturnIfKeyExists($arrayKey) {
        if(array_key_exists($arrayKey, $this->gameArray)) {
            return $this->gameArray[$arrayKey];
        }

        throw new KeyNotFoundException();
    }

    public function MinSteps() {
        return $this->ReturnIfKeyExists('FVinsMin');
    }

    public function MaxSteps() {
        return $this->ReturnIfKeyExists('FVinsMax');
    }


    public function Level() {
        return $this->ReturnIfKeyExists('FVlevel');
    }
}

class KeyNotfoundException extends Exception {}
