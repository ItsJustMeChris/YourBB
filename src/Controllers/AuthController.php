<?php
namespace YourBB\Controllers;

class AuthController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function login()
    {
        $users = new \YourBB\Classes\Users;
        if ($users->loggedIn())
        {
            die(json_encode(["error" => $users->loggedInError]));
        }
        if (isset($_POST['username']) && isset($_POST['password']))
        {
            if (strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5)
            {
                die(json_encode(["error" => $users->invalidLoginError]));
            }
            $users->login($_POST['username'], $_POST['password']);
            $this->model->data['template'] = (TEMPLATES_PATH.'main.php');
            $this->model->data['username'] = $users->currentUserName();
            $this->model->data['loggedin'] = $users->loggedIn();
        }
        else
        {
            die(json_encode(["error" => $users->invalidFieldsError]));
        }
    }

    public function logout()
    {
        $users = new \YourBB\Classes\Users;
        $users->logOut();
        $this->model->data['template'] = (TEMPLATES_PATH.'main.php');
        $this->model->data['username'] = $users->currentUserName();
        $this->model->data['loggedin'] = $users->loggedIn();
    }

    public function register()
    {
        $users = new \YourBB\Classes\Users;
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
        {
            if (strlen($_POST['email']) < 5 || strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5)
            {
                die(json_encode(["error" => $users->registerError]));
            }
            $users->register($_POST['username'], $_POST['email'], $_POST['password']);
        }
        else
        {
            die(json_encode(["error" => $users->invalidFieldsError]));
        }
    }
}
