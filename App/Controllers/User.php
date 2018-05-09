<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User as UserModel;
use \Core\Session;

class User extends \Core\Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function registerAction()
    {
        UserModel::create($_POST);
        View::renderTemplate('User/register.html', [
            
        ]);
    }

    public function logInAction()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (UserModel::login($_POST['username'], $_POST['password'])) {
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

    public function viewAction() {
        $userData = UserModel::getUser($this->route_params['id']);
        if ($userData) {
            View::renderTemplate('User/user.html', [
                'userInfo' => $userData[0]
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

    public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
        echo '<p>Route parameters: <pre>' .
             htmlspecialchars(print_r($this->route_params, true)) . '</pre></p>';
    }
}
