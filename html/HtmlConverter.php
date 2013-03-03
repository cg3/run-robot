<?php

class HtmlConverter
{
    public static function toArray($html)
    {
        $gameString = self::extractLevelString($html);
        return self::convertStringToArray($gameString);
    }
    
    private static function extractLevelString($html)
    {
        preg_match("/FVterr.*\"/",$html, $results);
        return trim($results[0],'"');
    }
    
    private static function convertStringToArray($string)
    {
        $result = array();
        $params = explode('&', $string);
        foreach($params as $param)
        {
            list($name, $value) = explode('=', $param);
            $result[$name] = $value;
        }
        
        return $result;
    }
}
