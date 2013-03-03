<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'autoload.php';

class OfflineLoaderTest extends PHPUnit_Framework_TestCase {

    public function testLoad() {
        $offlineLoader = new OfflineLoader();
        $offlineLoader->init('lvl5.html');
        $actual = $offlineLoader->load();

        $expected = $this->preparedGameBoard();

        $this->assertEquals($expected, $actual);
    }

    protected function preparedGameBoard() {
        return new RunRobotGameBoard(5,'....X.....X.....XX.X...XX');
    }
}
