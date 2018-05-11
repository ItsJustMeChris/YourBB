<?php

namespace App\Models;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use App\Models\User as UserModel;
use PDO;

class Post extends \Core\Base\Model
{
    public static function create($threadID, $userKey, $content) 
    {
        if ($threadID == '' || $content == '' || !UserModel::getUserFromKey($userKey)) {
            return false;
        }
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
    }
}
