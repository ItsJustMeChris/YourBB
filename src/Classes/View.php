<?php
namespace YourBB\Classes;

class View
{
    public static $validRoutes = array();

    public static function CreateView($viewName)
    {
        require_once(VIEWS_PATH.$viewName.'.php');
    }
}
