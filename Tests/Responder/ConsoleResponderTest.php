<?php

require_once 'PHPUnit/Autoload.php';
require_once 'Responder/Responder.php';
require_once 'Responder/ConsoleResponder.php';

class ConsoleResponderTest extends PHPUnit_Extensions_OutputTestCase {

    public function testCreate() {
        $responder = new ConsoleResponder();
    }

    public function testAnswer(){
        $responder = new ConsoleResponder();
        $answer = 'Solution.';
        $this->expectOutputString($answer);
        $responder->answer($answer);
    }
}

?>
