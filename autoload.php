<?php
function __autoload($class_name) 
{
    $applicationPathList = array('.', 'html', 'model', 'Model', 'Loader', 'Solver', 'Responder');
    foreach($applicationPathList as $path)
    {
        $classFile = $path . '/' .$class_name. '.php';
        if(file_exists($classFile)) 
        {
            require_once($classFile);
        }
    }
}