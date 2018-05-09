<?php
namespace App\Controllers;

use \Core\View;
use \Core\Session;
use App\Models\Category as CategoryModel;

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
        $categories = CategoryModel::getAll();
        View::renderTemplate('Home/index.html', [
            'categories' => $categories
        ]);
    }
}
