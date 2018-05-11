<?php

namespace App\Models;

use PDO;
use App\Models\User as UserModel;

class Thread extends \Core\Model
{
    public static function create($forumID, $userKey, $threadTitle, $threadContents) 
    {
        if ($forumID == '' || $userKey == '' || $threadTitle == '' || $threadContents == '' || !UserModel::getUserFromKey($userKey)) {
            return false;
        }
        //get userid from post key
        $user = UserModel::getUserFromKey($userKey);
        $threadCreateDate = date("Y-m-d H:i:s");
        $test = array(
            'thread_id' => $forumID, 
            'title' => $threadTitle, 
            'locked' => 0,
            'post_time' => $threadCreateDate,
            'last_edit_time' => $threadCreateDate,
            'creator_id' => $user[0]['ID'],
            'content' => $threadContents
        );
        static::insert('forum_threads', $test);
        return true;
    }

    public static function getThreadByID($id) 
    {
        //        $arr = static::select('user', 'username=? AND password=?', ['Joe', '$2y$10$d2BxUUNCV38YHhEowAef0em6fqTtA6iymhR4dLVyTmcW0P6hjhIB6']);
        $arr = static::select('forum_threads', 'ID=?', [$id]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getThreadPosts($id) 
    {
        //        $arr = static::select('user', 'username=? AND password=?', ['Joe', '$2y$10$d2BxUUNCV38YHhEowAef0em6fqTtA6iymhR4dLVyTmcW0P6hjhIB6']);
        $arr = static::select('thread_comments', 'comment_id=?', [$id]);
        if ($arr) {
            return $arr;
        }
        return false;
    }
}
