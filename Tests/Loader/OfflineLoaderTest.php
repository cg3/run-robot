<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Loader/Loader.php';
require_once 'Loader/OfflineLoader.php';
require_once 'html/HtmlConverter.php';
require_once 'model/RunRobotGameBoard.php';

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
