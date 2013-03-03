<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Model/GameArray.php';

class GameArrayTest extends PHPUnit_Framework_TestCase {

    public static $TERRAIN = '....X.....X.....XX.X...XX';
    public static $MINSTEPS = 2;
    public static $MAXSTEPS = 3;
    public static $LEVEL = 5;

    public function testCreate() {
        $gameArray = $this->preparedGameArray();
    }

    private function preparedGameArray() {
        return new GameArray(array(
            'FVterrainString'=>self::$TERRAIN,
            'FVinsMax'=>self::$MAXSTEPS,
            'FVinsMin'=>self::$MINSTEPS,
            'FVboardX'=>'5',
            'FVboardY'=>'5',
            'FVlevel'=>self::$LEVEL
        ));

    }

    public function testTerrain() {
        $gameArray = $this->preparedGameArray();
        $this->assertEquals(self::$TERRAIN, $gameArray->Terrain());
    }

    public function testMinSteps() {
        $gameArray = $this->preparedGameArray();
        $this->assertEquals(self::$MINSTEPS, $gameArray->MinSteps());
    }

    public function testMaxSteps() {
        $gameArray = $this->preparedGameArray();
        $this->assertEquals(self::$MAXSTEPS, $gameArray->MaxSteps());
    }

    public function testLevel() {
        $gameArray = $this->preparedGameArray();
        $this->assertEquals(self::$LEVEL, $gameArray->Level());
    }
}
