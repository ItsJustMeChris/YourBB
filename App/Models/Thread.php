<?php

namespace App\Models;

use PDO;
use App\Models\User as UserModel;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;

class Thread extends \Core\Base\Model
{
    public static function create($forumID, $userKey, $threadTitle, $threadContents) 
    {
        if ($forumID == '' || $userKey == '' || $threadTitle == '' || $threadContents == '' || !UserModel::getUserFromKey($userKey)) {
            return false;
        }
        $user = UserModel::getUserFromKey($userKey);
        $threadCreateDate = date("Y-m-d H:i:s");
        $test = array(
            'forum_id' => $forumID, 
            'title' => $threadTitle, 
            'locked' => 0,
            'post_time' => $threadCreateDate,
            'last_edit_time' => $threadCreateDate,
            'creator_id' => $user[0]['ID'],
            'creator_name' => $user[0]['username'],
            'content' => $threadContents
        );
        static::insert('forum_threads', $test);
        return true;
    }

    public static function getThreadByID($id) 
    {
        $arr = static::select('forum_threads', 'ID=?', [$id]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getThreadPosts($id) 
    {
        $arr = static::select('thread_comments', 'thread_id=?', [$id]);
        if ($arr) {
            return $arr;
        }
        return false;
    }
}
