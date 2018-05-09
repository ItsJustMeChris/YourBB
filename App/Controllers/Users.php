<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User;
use \Core\Session;

class Users extends \Core\Controller
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
        User::create($_POST);
        View::renderTemplate('User/register.html', [
            
        ]);
    }

    public function logInAction()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (User::login($_POST['username'], $_POST['password'])) {
                $data = [ 'type' => 'success', 'title' => 'yay!', 'text' => 'Login successful, redirecting!' ];
            } else {
                $data = [ 'type' => 'error', 'title' => 'oh no!', 'text' => 'Your login information was incorrect!' ];
            }
            header('Content-type: application/json');
            echo json_encode( $data );        
        } else {
            View::renderTemplate('User/login.html', [
                'session' => Session::get('user')
            ]);
        }
    }

    public function logOutAction()
    {
        Session::destroy();
    }

    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
