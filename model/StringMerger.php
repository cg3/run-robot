<?php

class StringMerger
{

    public static function mergeStrings($base, $operand)
    {
        for($i=0;$i<strlen($base);$i++)
        {
            if($base[$i] == '.' && $operand[$i]=='X')
            {
                $base[$i] = '+';
            }
        }

        return $base;
    }
}
