<?php

class ConsoleResponder implements Responder {
    public function answer($solution) {
        echo $solution;
    }    
}