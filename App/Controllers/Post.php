<?php
namespace App\Controllers;

use \Core\View;
use \Core\Session;
use App\Models\Thread as ThreadModel;
use App\Models\Post as PostModel;

class Post extends \Core\Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function addNewAction()
    {
        if (isset($_POST['thread_id']) && isset($_POST['post_content'])) {
            if (PostModel::create($_POST['thread_id'], Session::get('user'), $_POST['post_content'])) {
                $data = [ 'type' => 'success', 'title' => 'Bye!', 'text' => 'Logged out!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'on no!', 'text' => 'Failed to post thread!' ];
            }
        }
        header('Content-type: application/json');
        echo json_encode( $data );             
    }

    public function viewAction() {
        $threadData = ThreadModel::getThreadByID($this->route_params['id']);
        if ($threadData) {
            //$threadPosts = ThreadModel::getThreadPosts($forumData[0]['ID']);
            View::renderTemplate('Thread/view.html', [
                'threadInfo' => $threadData[0]
            ]); 
        } else {
            echo '??';
        }
    }
    
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
