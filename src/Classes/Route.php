<?php
namespace YourBB\Classes;

class Route
{
    public static $validRoutes = array();

    public static function set($route, $function)
    {
        self::$validRoutes[] = $route;
        //print_r(self::$validRoutes);
        $params = explode("/", $_GET['query']);

        if ($params[0] == $route)
        {
            $function->__invoke();
        }
    }
}
?>
