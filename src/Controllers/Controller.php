<?php
namespace YourBB\Controllers;

class Controller
{
    public static function CreateView($viewName)
    {
        require_once(VIEWS_PATH.$viewName.'.php');
    }
}
