<?php

namespace App\Controllers;

use \Core\View;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use App\Models\Category as CategoryModel;

class Category extends \Core\Base\Controller
{
    public function viewAction() {
        $categoryData = CategoryModel::getCategory($this->route_params['id']);
        if ($categoryData) {
            $categoryThreads = CategoryModel::getCategoryThreads($categoryData[0]['ID']);
            View::renderTemplate('Category/view.html', [
                'categoryInfo' => $categoryData[0],
                'threads' => $categoryThreads
            ]); 
        } else {
            echo '??';
        }
    }
}
