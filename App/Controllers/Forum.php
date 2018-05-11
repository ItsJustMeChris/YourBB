<?php

namespace App\Controllers;

use \Core\View;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use App\Models\Forum as ForumModel;

class Forum extends \Core\Base\Controller
{
    public function viewAction() {
        $forumData = ForumModel::getForumByID($this->route_params['id']);
        if ($forumData) {
            $forumThreads = ForumModel::getForumThreads($forumData[0]['ID']);
            View::renderTemplate('Forum/view.html', [
                'forumInfo' => $forumData[0],
                'threads' => $forumThreads
            ]); 
        } else {
            echo '??';
        }
    }
}
