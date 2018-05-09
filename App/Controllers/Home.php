<?php
namespace App\Controllers;

use \Core\View;
use \Core\Session;


class Home extends \Core\Controller
{
    protected function before()
    {
        //echo "(before) ";
        //return false;
    }

    protected function after()
    {
        //echo " (after)";
    }

    public function indexAction()
    {
        echo Session::get('user');
        View::renderTemplate('Home/index.html', [
        ]);
    }
}
