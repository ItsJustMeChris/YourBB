<?php

namespace App\Models;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;

use PDO;

class Category extends \Core\Base\Model
{
    public static function create($stuff) 
    {
        if (isset($_POST['name']) && isset($_POST['description'])) {
            if ($_POST['name'] == '' || $_POST['description'] == '') {
                return false;
            }
            $test = array(
                'name' => $_POST['name'], 
                'description' => $_POST['description']
            );
            static::insert('forum_categories', $test);
            return true;
        }
        return false;
    }

    public static function getCategory($categoryName) 
    {
        $arr = static::select('forum_categories', 'name=?', [$categoryName]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getCategoryThreads($categoryID) {
        $arr = static::select('category_threads', 'ID=?', [$categoryID]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getAll()
    {    
        return static::query('SELECT * FROM forum_categories ORDER BY id');
    }
}
