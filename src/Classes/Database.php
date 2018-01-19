<?php
namespace YourBB\Classes;

class Database
{
    public static $loggedInError = 'Already Logged In';
    public static $invalidLoginError = 'Invalid Username or Password';
    public static $invalidFieldsError = 'Invalid Fields';
    private static $host = 'localhost';
    private static $user = 'WNQXNh7PpXM5phTQ';
    private static $pass = 'PDMY7rNc5V223AFaT5TdGxKjApkssRVJXTDYtNTT4CyGKyBKp7';
    private static $db = 'userauth';

    public static function query($f_query)
    {
        $mysqli = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);
        return $mysqli->query($f_query);
    }

    public static function escape($f_string)
    {
        $mysqli = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);
        return $mysqli->escape_string($f_string);
    }

    public static function setup()
    {
        $mysqli = mysqli_connect(self::$host, self::$user, self::$pass, self::$db);
        $mysqli->query('
        CREATE TABLE IF NOT EXISTS `'.self::$db.'`.`users`
        (
            `id` INT NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(50) NOT NULL,
            `email` VARCHAR(100) NOT NULL,
            `password` VARCHAR(100) NOT NULL,
            `session` VARCHAR(100) NOT NULL DEFAULT 0,
            `regdate` datetime NOT NULL,
            `active` BOOL NOT NULL DEFAULT 0,
        PRIMARY KEY (`id`)
        );') or die($mysqli->error);
    }
}
