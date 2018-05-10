<?php
namespace App\Controllers;

use \Core\View;
use App\Models\Thread as ThreadModel;

class Thread extends \Core\Controller
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
        if (isset($_POST['categoryid']) && isset($_POST['user_key']) && isset($_POST['thread_title']) && isset($_POST['thread_details'])) {
            if (ThreadModel::create($_POST['categoryid'], $_POST['user_key'], $_POST['post_content'], $_POST['post_content'])) {
                $data = [ 'type' => 'success', 'title' => 'Bye!', 'text' => 'Logged out!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'on no!', 'text' => 'Failed to post thread!' ];
            }
        } 
        header('Content-type: application/json');
        echo json_encode( $data );             
    }

    public function viewAction() {
        var_dump($this->route_params);
    }
    
    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
