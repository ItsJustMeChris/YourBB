<?php
namespace YourBB\Controllers;

class Controller
{
    public static function hook($action)
    {
        static::$action();
    }
}
