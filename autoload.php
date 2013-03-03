<?php
function __autoload($class_name) 
{
    $applicationPathList = array('.', 'html', 'model');
    foreach($applicationPathList as $path)
    {
        $classFile = $path . '/' .$class_name. '.php';
        if(file_exists($classFile)) 
        {
            require_once($classFile);
        }
    }
}