<?php
include_once 'constants.php';

class Terrain {

    public $gameBoard;
    public $Size;

    public function __construct($size, $terrain) {
        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $this->gameBoard[$y][$x] = $terrain[$y * $size + $x];
            }
        }

        $this->Size = $size;
    }

    public function printOut() {
        foreach ($this->gameBoard as $column) {
            echo implode('', $column) . "\n";
        }
    }

    public function __toString() {
        $result = "";
        foreach ($this->gameBoard as $column) {
            $result .= implode('', $column);
        }
        return $result;
    }

    public function field($x, $y) {
        if (!$this->positionOnGameBoard($x, $y))
            throw new Exception('Index out of bounds.');

        return $this->gameBoard[$y][$x];
    }

    public function isMine($x, $y) {
        if (!$this->positionOnGameBoard($x, $y))
            return false;
        return $this->mineField($x, $y);
    }

    private function mineField($x, $y) {
        return ($this->field($x, $y) == MINE_FIELD);
    }

    public function endPointEmpty($x, $y) {
        $testX = $x - 1;
        $testY = $y - 1;
        while ($this->positionOnGameBoard($testX, $testY)) {
            if ($this->mineField($testX, $testY)) {
                return false;
            }
            $testX += $x;
            $testY += $y;
        }
        return true;
    }

    public function positionOnGameBoard($x, $y) {
        return $x < $this->Size && $y < $this->Size && $x >= 0 && $y >= 0;
    }
}
