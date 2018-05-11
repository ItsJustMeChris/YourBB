<?php
namespace App\Controllers;

use \Core\View;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use App\Models\Thread as ThreadModel;
use App\Models\Post as PostModel;

class Post extends \Core\Base\Controller
{
    public function addNewAction()
    {
        if (isset($_POST['thread_id']) && isset($_POST['post_content'])) {
            if (PostModel::create($_POST['thread_id'], Session::get('user'), $_POST['post_content'])) {
                $data = [ 'type' => 'success', 'title' => 'Yay!', 'text' => 'Comment posted!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'on no!', 'text' => 'Failed to post comment!' ];
            }
        }
        header('Content-type: application/json');
        echo json_encode( $data );             
    }
}
