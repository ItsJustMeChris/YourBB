<?php

namespace App\Controllers;

use \Core\View;
use \Core\Session;
use App\Models\Forum as ForumModel;

class Forum extends \Core\Controller
{
    public function indexAction()
    {
        $posts = Post::getAll();

        View::renderTemplate('Posts/index.html', [
            'posts' => $posts
        ]);
    }

    public function viewAction() {
        $categoryData = ForumModel::getCategory($this->route_params['id']);
        if ($categoryData) {
            $categoryThreads = ForumModel::getCategoryThreads($categoryData[0]['ID']);
            View::renderTemplate('Category/view.html', [
                'forumInfo' => $forumData[0],
                'threads' => $categoryThreads
            ]); 
        } else {
            echo '??';
        }
    }
}
