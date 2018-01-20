<?php
namespace YourBB\Classes;

class Controller
{
    public static $hooks = array();

    public static function hook($action, $params)
    {
        static::$action($params);
    }
}
