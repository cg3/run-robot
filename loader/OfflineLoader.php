<?php

class OfflineLoader implements Loader {

    private $htmlFileContent;

    public function init($htmlFile) {
        $this->htmlFileContent = file_get_contents($htmlFile);
    }

    public function load() {
        $gameArray = HtmlConverter::toArray($this->htmlFileContent);
        return new RunRobotGameBoard($gameArray['FVboardX'], $gameArray['FVterrainString']);
    }
}
