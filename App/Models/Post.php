<?php

namespace App\Models;
use \Core\Session;
use App\Models\User as UserModel;

use PDO;

class Post extends \Core\Model
{
    public static function create($threadID, $userKey, $content) 
    {
        if ($threadID != '' && $content != '') {
            $user = UserModel::getUserFromKey($userKey);
            $postCreateDate = date("Y-m-d H:i:s");
            $test = array(
                'comment_id' => $threadID, 
                'poster_id' => $user[0]['ID'],
                'post_time' => $postCreateDate, 
                'last_edit_time' => $postCreateDate,
                'content' => $content
            );
            static::insert('thread_comments', $test);
            return true;
        } else {
            return false;
        }
    }
}
