<?php
namespace YourBB\Controllers;
use YourBB\Classes\Database as db;
use YourBB\Classes\Controller as Controller;
use YourBB\Classes\View as view;

class AuthController extends Controller
{
    public static $loggedInError = 'Already Logged In';
    public static $invalidLoginError = 'Invalid Username or Password';
    public static $invalidFieldsError = 'Invalid Fields';
    public static $notLoggedInError = 'Not Logged In';
    public static $userExistsError = 'User Exists';
    public static $registerError = 'Invalid Username, Email, or Password';
    public static $logoutMessage = 'Logged Out';
    public static $loggedInMessage = 'Logged In';
    public static $userCreatedMessage = 'User Created';

    public static function loggedIn()
    {
        $randomString = db::escape(session_id());
        $result = db::query("SELECT * FROM `users` WHERE `session`='$randomString'");
        if ($result->num_rows > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                if (session_id() == $row['session'])
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    public static function logout() {
        session_regenerate_id(true);
        session_destroy();
        $_SESSION = array();
    }

    public static function currentUserID()
    {
        if (self::loggedIn())
        {
            $randomString = db::escape(session_id());
            $result = db::query("SELECT * FROM `users` WHERE `session`='$randomString'");
            if ($result->num_rows > 0)
            {
                while ($row = mysqli_fetch_array($result))
                {
                    return $row['id'];
                }
            }
            else
            {
                return 0;
            }
        }
    }

    public static function currentUserName()
    {
        if (self::loggedIn())
        {
            $randomString = db::escape(session_id());
            $result = db::query("SELECT * FROM `users` WHERE `session`='$randomString'");
            if ($result->num_rows > 0)
            {
                while ($row = mysqli_fetch_array($result))
                {
                    return $row['username'];
                }
            }
            else
            {
                return "Guest";
            }
        }
        else
        {
            return "Guest";
        }
    }

    public static function validateSession($f_userid, $f_sessionkey)
    {
        $sessionKey = db::escape($f_sessionkey);
        $userID = intval($f_userid);
        $result = db::query("SELECT * FROM `users` WHERE `id`='$userID' AND `session`='$sessionKey'");
        if ($result->num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function generateToken() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 35; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function login()
    {
        $f_username = $_POST['username'];
        $f_password = $_POST['password'];
        $username = db::escape($f_username);
        $randomString = db::escape(session_id());
        $result = db::query("SELECT * FROM `users` WHERE UPPER(`username`)=UPPER('$username') OR UPPER(`email`)=UPPER('$username')");
        if ($result->num_rows > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                if (password_verify($f_password,$row['password']))
                {
                    db::query("UPDATE users SET `session`='$randomString' WHERE UPPER(`username`)=UPPER('$username')");
                }
                else
                {
                    die(json_encode(["error" => self::$invalidLoginError]));
                }
            }
        }
        else
        {
            die(json_encode(["error" => self::$invalidLoginError]));
        }
    }

    public static function register($f_username, $f_email, $f_password)
    {
        $email = db::escape($_POST['email']);
        $username = db::escape($_POST['username']);
        $passwordHash = db::escape(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 11]));
        $result = db::query("SELECT * FROM `users` WHERE `username`='$username' OR `email`='$email'");
        $timeNow = new DateTime();
        $timeNow = $timeNow->format("Y-m-d H:i:s");
        if ( $result->num_rows > 0 )
        {
            die(json_encode(["error" => self::$userExistsError]));
        }
        else
        {
            db::query("INSERT INTO users (username, email, password, regdate) VALUES ('$username', '$email', '$passwordHash', '$timeNow')");
            die(json_encode(["success" => self::$userCreatedMessage]));
        }
    }
}
