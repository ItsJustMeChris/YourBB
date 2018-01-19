<?php
namespace YourBB\Classes;

class Controller
{
    public static function hook($action)
    {
        static::$action();
    }
}
