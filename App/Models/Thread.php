<?php

namespace App\Models;

use PDO;

class Thread extends \Core\Model
{
    public static function create($categoryID, $userKey, $postTitle, $postContent) 
    {
        if ($categoryID == '' || $userKey == '' || $postTitle == '' || $postContent == '') {
            return false;
        }
        //get userid from post key
        $threadCreateDate = new date("Y-m-d H:i:s");
        $test = array(
            'ID' => $categoryID, 
            'title' => $postTitle, 
            'locked' => 0,
            'post_time' => $threadCreateDate,
            'last_edit_time' => $threadCreateDate,
            'creator_id' => $userKey,
            'content' => $postContent
        );
        static::insert('forum_threads', $test);
        return true;
    }

    public static function getAll()
    {    
        try {
            $db = static::getDB();

            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
