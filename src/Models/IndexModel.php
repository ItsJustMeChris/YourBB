<?php
namespace YourBB\Models;

class IndexModel
{
    public $data = array();

    public function __construct(){
        $users = new \YourBB\Classes\Users;
        $this->data['username'] = $users->currentUserName();
        $this->data['loggedin'] = $users->loggedIn();
        $this->data['template'] = (TEMPLATES_PATH.'main.php');
    }
}
