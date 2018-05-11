<?php

namespace App\Controllers\Admin;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;

class Users extends \Core\Base\Controller
{
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    public function indexAction()
    {
        echo 'User admin index';
    }
}
