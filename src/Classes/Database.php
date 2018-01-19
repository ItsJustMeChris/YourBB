<?php
namespace YourBB\Classes;

class Database
{
    public static $loggedInError = 'Already Logged In';
    public static $invalidLoginError = 'Invalid Username or Password';
    public static $invalidFieldsError = 'Invalid Fields';

    public static function query($f_query)
    {
        $mysqli = mysqli_connect(YOURBBCONFIG['database']['host'], YOURBBCONFIG['database']['user'], YOURBBCONFIG['database']['pass'], YOURBBCONFIG['database']['db']);
        return $mysqli->query($f_query);
    }

    public static function escape($f_string)
    {
        $mysqli = mysqli_connect(YOURBBCONFIG['database']['host'], YOURBBCONFIG['database']['user'], YOURBBCONFIG['database']['pass'], YOURBBCONFIG['database']['db']);
        return $mysqli->escape_string($f_string);
    }

    public static function setup()
    {
        $mysqli = mysqli_connect(YOURBBCONFIG['database']['host'], YOURBBCONFIG['database']['user'], YOURBBCONFIG['database']['pass'], YOURBBCONFIG['database']['db']);
        $mysqli->query('
        CREATE TABLE IF NOT EXISTS `'.YOURBBCONFIG['database']['db'].'`.`users`
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

        $mysqli->query('
        CREATE TABLE IF NOT EXISTS `'.YOURBBCONFIG['database']['db'].'`.`forums`
        (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(50) NOT NULL,
            `description` VARCHAR(100) NOT NULL,
        PRIMARY KEY (`id`)
        );') or die($mysqli->error);
    }
}
