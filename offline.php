<?php
require_once 'autoload.php';

$loader = new OfflineLoader();
$solver = new BackTrackSolver();
$responder = new ConsoleResponder(); 
$rrsolver = new RunRobotSolver($loader, $solver, $responder);
$rrsolver->solve(); 

