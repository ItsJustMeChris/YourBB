<?php

namespace App\Controllers;

use \Core\View;
use \Core\Session;
use App\Models\Category as CategoryModel;

class Category extends \Core\Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function viewAction() {
        $categoryData = CategoryModel::getCategory($this->route_params['id']);
        if ($categoryData) {
            $categoryThreads = CategoryModel::getCategoryThreads($categoryData[0]['ID']);
            View::renderTemplate('Category/view.html', [
                'categoryInfo' => $categoryData[0],
                'threads' => $categoryThreads
            ]); 
        } else {
            echo '??';
        }
    }

    public function logOutAction()
    {
        if (Session::get('user')) {
            $data = [ 'type' => 'success', 'title' => 'Bye!', 'text' => 'Logged out!' ];
            Session::destroy();
        } else {
            $data = [ 'type' => 'error', 'title' => 'oh no!', 'text' => 'Logout Failed!' ];
        }
        header('Content-type: application/json');
        echo json_encode( $data );     
    }
}
