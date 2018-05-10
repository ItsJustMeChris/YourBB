<?php
namespace App\Controllers;

use \Core\View;
use \Core\Session;
use App\Models\Category as CategoryModel;
use App\Models\Forum as ForumModel;

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
        
        $forums = [];

        foreach($categories as $cat) {
            $forums[$cat['ID']] = ForumModel::getForumsForCategory($cat['ID']);;
        }
        
        View::renderTemplate('Home/index.html', [
            'categories' => $categories,
            'forums' => $forums
        ]);
    }
}
