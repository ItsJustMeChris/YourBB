<?php

namespace App\Models;
use \Core\Modules\Session;
use \Core\Modules\Debugger as Debug;
use PDO;

class User extends \Core\Base\Model
{
    public static function login($username, $password) 
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $arr = static::select('users', 'UPPER(username)=?', [strtoupper($username)]);
            if ($arr) {
                if (password_verify($password, $arr[0]['password'])) {
                    return $arr;
                }
            }
        }
        return false;
    }

    public static function getUserFromKey($key) {
        $arr = static::select('users', 'user_key=?', [$key]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function getUser($username) 
    {
        $arr = static::select('users', 'username=?', [strtoupper($username)]);
        if ($arr) {
            return $arr;
        }
        return false;
    }

    public static function create($stuff) 
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            $passwordHashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $test = array(
                'username' => $_POST['username'], 
                'password' => $passwordHashed,
                'reg_ip' => $ip,
                'cur_ip' => $ip,
                'user_key' => bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)),
                'profile_image' => '',
                'user_group' => 1,
                'banned' => 0
            );
            static::insert('users', $test);    
        }
    }
}
