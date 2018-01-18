<?php
namespace YourBB\Models;

class AuthModel
{
    public $data = array();

    public function __construct(){
        $users = new \YourBB\Classes\Users;
        if ($users->loggedIn())
        {
            $this->data['username'] = $users->currentUserName();
            $this->data['loggedin'] = $users->loggedIn();
            $this->data['page'] = (TEMPLATES_PATH.'main.php');
            $this->template = (TEMPLATES_PATH.'index.php');
        }
        else
        {
            $this->data['username'] = $users->currentUserName();
            $this->data['loggedin'] = $users->loggedIn();
            $this->data['page'] = (TEMPLATES_PATH.'auth.php');
            $this->template = (TEMPLATES_PATH.'index.php');
        }
    }
}
