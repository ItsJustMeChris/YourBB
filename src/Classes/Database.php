<?php
namespace YourBB\Classes;

class Database
{
    public $loggedInError = 'Already Logged In';
    public $invalidLoginError = 'Invalid Username or Password';
    public $invalidFieldsError = 'Invalid Fields';
    private $host = 'localhost';
    private $user = 'username';
    private $pass = 'password';
    private $db = 'database';

    function query($f_query)
    {
        $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        return $mysqli->query($f_query);
    }

    function escape($f_string)
    {
        $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        return $mysqli->escape_string($f_string);
    }

    function setup()
    {
        $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        $mysqli->query('
        CREATE TABLE IF NOT EXISTS `'.$this->db.'`.`users`
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
?>
