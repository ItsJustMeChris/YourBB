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
