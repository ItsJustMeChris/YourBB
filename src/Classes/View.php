<?php
namespace YourBB\Classes;
use YourBB\Controllers\AuthController as user;
class View
{
    public static $user = "YourBB\Controllers\AuthController";
    public static $controller;

    public static function CreateView($viewName)
    {
        ob_start();
        require_once(VIEWS_PATH.'/templates/header.php');
        require_once(VIEWS_PATH.$viewName.'.php');
        require_once(VIEWS_PATH.'/templates/footer.php');
        $str = ob_get_contents();
        ob_end_clean();
        return $str;
    }

    public static function controller($controller)
    {
        self::$controller = $controller;
    }
}
