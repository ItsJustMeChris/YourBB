<?php
namespace YourBB\Models;

class AuthModel
{
    public $data = array();

    public function __construct(){
        $users = new \YourBB\Classes\Users;
        if ($users->loggedIn())
        {
            header('Location: /');
        }
        else
        {
            $this->data['username'] = $users->currentUserName();
            $this->data['loggedin'] = $users->loggedIn();
            $this->template = (TEMPLATES_PATH.'auth.php');
        }
    }
}
