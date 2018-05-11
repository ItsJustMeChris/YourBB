<?php

namespace App\Controllers;

use \Core\View;
use App\Models\User as UserModel;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;

class User extends \Core\Base\Controller
{
    public function registerAction()
    {
        UserModel::create($_POST);
        View::renderTemplate('User/register.html', [
        ]);
    }

    public function logInAction()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $userInfo = UserModel::login($_POST['username'], $_POST['password']);
            if ($userInfo) {
                Session::put('user', $userInfo[0]['user_key']);
                Session::put('username', $userInfo[0]['username']);
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
}
