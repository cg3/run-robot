<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include 'autoload.php';
include 'constants.php';

$level = 84;

echo 'Downloading..'."\n";
$html = new RunRobotHtml();
$html->getLevel($level);
$ga = $html->gameArray();
echo "Level:".$ga['FVlevel']."\n";
$model = new RunRobotModel($ga);
//$optimizer = new RunRobotGameBoardOptimizer($model->gameBoard);
//$model->gameBoard = $optimizer->optimize();
echo "Solving..\n";

function solve($cmodel)
{
    global $html;
            $solver = new RunRobotBackTrackSolver($cmodel);
            $answer = $solver->__toString();
            if($answer != false)
            {
                echo "Got: $answer\n";
                $html->sendAnswer($answer);
                exit;
            }
}


for($s=$model->minSteps;$s<=$model->maxSteps;$s++)
{
    for($x=1;$x<=$s;$x++)
    {
        $y = $s - $x;
        if(!$model->gameBoard->endPointEmpty($x, $y))
        {
//            echo "found candidate on $x, $y..";
            //            $cmodel->gameBoard->optimize();
            $cmodel = clone $model;
            $cmodel->gameBoard->fold($x,$y);
            $cmodel->minSteps = $s;
            $cmodel->maxSteps = $s;
            solve($cmodel);
//            echo "no\n";
        }
    }
}

// last resort - back track
echo "Backtracking..\n";
//solve($model);

