<?php

namespace App\Controllers\Admin;

use \Core\View;
use \Core\Session;
use App\Models\Category as CategoryModel;
use App\Models\Forum as ForumModel;

class Forum extends \Core\Controller
{
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    public function indexAction()
    {
        echo 'User admin index';
    }

    public function createNewCategoryAction()
    {
        if (isset($_POST['name']) && isset($_POST['description'])) {
            if (CategoryModel::create($_POST['name'], $_POST['description'])) {
                $data = [ 'type' => 'success', 'title' => 'yay!', 'text' => 'Created Category!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'oh no!', 'text' => 'Failed Creation' ];
            }
            header('Content-type: application/json');
            echo json_encode( $data );        
        } else {
            View::renderTemplate('Admin/category.html', [
                'session' => Session::get('user')
            ]);
        }
    }

    public function createNewForumAction()
    {
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['category_id'])) {
            if (ForumModel::create($_POST['category_id'], $_POST['title'], $_POST['content'])) {
                $data = [ 'type' => 'success', 'title' => 'yay!', 'text' => 'Created Category!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'oh no!', 'text' => 'Failed Creation' ];
            }
            header('Content-type: application/json');
            echo json_encode( $data );        
        } else {
            View::renderTemplate('Admin/forum.html', [
            ]);
        }
    }
}
