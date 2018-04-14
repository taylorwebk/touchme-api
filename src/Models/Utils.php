<?php
namespace Models;
class Utils
{
    public static function validateData($data, $fields)
    {
        foreach ($fields as $value) {
            if (! isset($data[$value])) {
                return false;
            }
        }
        return true;
    }
    public static function implodeFields($fields) {
        return 'No se reconocen uno o varios de los campos: '. implode(', ', $fields);
    }
    public static function inMultiarray($elem, $array, $key)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
            if ($array[$bottom][$key] == $elem) {
                return true;
            }        
            $bottom++;
        }        
        return false;
    }
}
