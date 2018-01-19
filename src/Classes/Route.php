<?php
namespace YourBB\Classes;

use YourBB\Classes\View as view;

class Route
{
    public static $validRoutes = array();
    public static $validActions = array();
    public static $params;
    public static $controller;

    public static function set($name, $route, $hooks, $function)
    {
        self::$validRoutes[] = explode("/", $route);
        self::$validActions['b'] = explode("/", $hooks);
        self::$params = explode("/", $_GET['query']);
        if (self::$params[0] == '')
        {
            self::$params[0] = 'index';
        }
        if (strpos($route, self::$params[0]) !== false)
        {
            if (isset(self::$params[1]))
            {
                if (in_array(self::$params[1], self::$validActions['b']))
                {
                    $controllerName = "YourBB\Controllers\\".ucwords(self::$params[0])."Controller";
                    $controllerName::hook(self::$params[1]);
                }
            }
            $controller = $route;
            $function->__invoke();
        }
    }

    public static function check()
    {
        //$params = explode("/", $_GET['query']);
        if (self::$params[0] == '')
        {
            self::$params[0] = 'index';
        }
        foreach (self::$validRoutes as $key => $value)
        {
            foreach (self::$validRoutes[$key] as $key => $value)
            {
                if (self::$params[0] == $value)
                {
                    return true;
                }
            }
        }
        die("404");
    }
}
?>
