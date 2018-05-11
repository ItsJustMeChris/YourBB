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

    public static function getForumByName($categoryName) 
    {
        //        $arr = static::select('user', 'username=? AND password=?', ['Joe', '$2y$10$d2BxUUNCV38YHhEowAef0em6fqTtA6iymhR4dLVyTmcW0P6hjhIB6']);
        $arr = static::select('category_forums', 'name=?', [$categoryName]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getForumByID($id) 
    {
        //        $arr = static::select('user', 'username=? AND password=?', ['Joe', '$2y$10$d2BxUUNCV38YHhEowAef0em6fqTtA6iymhR4dLVyTmcW0P6hjhIB6']);
        $arr = static::select('category_forums', 'ID=?', [$id]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getForumsForCategory($categoryID) {
        $arr = static::select('category_forums', 'forum_id=?', [$categoryID]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getForumThreads($categoryID) {
        $arr = static::select('forum_threads', 'thread_id=?', [$categoryID]);
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
