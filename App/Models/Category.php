<?php

namespace App\Models;
use \Core\Session;

use PDO;

class Category extends \Core\Model
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

    public static function getAll()
    {    
        return static::query('SELECT * FROM forum_categories ORDER BY id');
    }
}
