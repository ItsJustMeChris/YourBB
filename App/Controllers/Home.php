<?php
namespace App\Controllers;

use \Core\View;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use \Core\Modules\Events\EventListener as EventListener;
use App\Models\Category as CategoryModel;
use App\Models\Forum as ForumModel;

class Home extends \Core\Base\Controller
{
    public function indexAction()
    {
        EventListener::run('test');
        $categories = CategoryModel::getAll();
        $forums = [];
        foreach($categories as $cat) {
            $forums[$cat['ID']] = ForumModel::getForumsForCategory($cat['ID']);
        }
        View::renderTemplate('Home/index.html', [
            'categories' => $categories,
            'forums' => $forums
        ]);
    }
}
