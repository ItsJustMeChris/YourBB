<?php

namespace App\Models;
use \Core\Session;

use PDO;

class Forum extends \Core\Model
{
    public static function create($categoryID, $title, $content) 
    {
        if ($categoryID != '' && $title != '') {
            $test = array(
                'forum_id' => $categoryID, 
                'title' => $title, 
                'locked' => 0, 
                'content' => $content
            );
            static::insert('category_forums', $test);
            return true;
        } else {
            return false;
        }
    }

    public static function getForumsForCategory($categoryID) {
        $arr = static::select('category_forums', 'forum_id=?', [$categoryID]);
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
