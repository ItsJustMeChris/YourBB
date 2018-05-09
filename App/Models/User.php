<?php

namespace App\Models;
use \Core\Session;

use PDO;

class User extends \Core\Model
{
    public static function login($username, $password) 
    {
        //        $arr = static::select('user', 'username=? AND password=?', ['Joe', '$2y$10$d2BxUUNCV38YHhEowAef0em6fqTtA6iymhR4dLVyTmcW0P6hjhIB6']);
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $arr = static::select('users', 'username=?', [strtoupper($username)]);
            if ($arr) {
                if (password_verify($password, $arr[0]['password'])) {
                    Session::put('user', $arr[0]['user_key']);
                    return true;
                }
            }
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
                'username' => strtoupper($_POST['username']), 
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
