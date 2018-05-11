<?php

namespace App\Controllers\Admin;

use \Core\View;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use App\Models\Category as CategoryModel;
use App\Models\Forum as ForumModel;

class Forum extends \Core\Base\Controller
{
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
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
}
