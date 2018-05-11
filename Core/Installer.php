<?php
namespace Core;

use PDO;
use App\Config;

class Installer {

    public static function setupDatabase() {
        $dsn = 'mysql:host=' . Config::DB_HOST . ';charset=utf8';
        $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
        $dbname = "`".str_replace("`","``",Config::DB_NAME)."`";
        $db->query("CREATE DATABASE IF NOT EXISTS $dbname");
        $db->query("use $dbname");

        $table = "users";
        try {
             $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             username VARCHAR( 50 ) NOT NULL, 
             password VARCHAR( 255 ) NOT NULL,
             reg_ip VARCHAR( 50 ) NOT NULL, 
             cur_ip VARCHAR( 50 ) NOT NULL, 
             user_key VARCHAR( 255 ) NOT NULL, 
             profile_image VARCHAR( 100 ) NOT NULL,
             user_group SMALLINT( 255 ) NOT NULL,
             banned TINYINT( 1 ) NOT NULL);" ;
             $db->exec($sql);
             print("Created $table Table.\n");
        
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $table = "forum_categories";
        try {
             $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR( 50 ) NOT NULL, 
             description VARCHAR( 200 ) NOT NULL);" ;
             $db->exec($sql);
             print("Created $table Table.\n");
        
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $table = "category_forums";
        try {
             $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             category_id int not null,
             FOREIGN KEY category_id(category_id) REFERENCES forum_categories(ID),
             title VARCHAR( 50 ) NOT NULL, 
             locked TINYINT( 1 ) NOT NULL, 
             content TEXT( 500 ) NOT NULL);" ;
             $db->exec($sql);
             print("Created $table Table.\n");
        
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $table = "forum_threads";
        try {
             $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             forum_id int not null,
             FOREIGN KEY forum_id(forum_id) REFERENCES category_forums(ID),
             creator_id INT( 11 ) NOT NULL,
             creator_name VARCHAR( 50 ) NOT NULL,
             post_time DATETIME NOT NULL,
             last_edit_time DATETIME NOT NULL,
             title VARCHAR( 50 ) NOT NULL, 
             locked TINYINT( 1 ) NOT NULL, 
             content TEXT( 500 ) NOT NULL);" ;
             $db->exec($sql);
             print("Created $table Table.\n");
        
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $table = "thread_comments";
        try {
             $sql ="CREATE table $table(
             ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
             thread_id int not null,
             FOREIGN KEY thread_id(thread_id) REFERENCES forum_threads(ID),
             poster_id INT( 11 ) NOT NULL,
             poster_name VARCHAR( 50 ) NOT NULL,
             post_time DATETIME NOT NULL,
             last_edit_time DATETIME NOT NULL,
             content TEXT( 500 ) NOT NULL);" ;
             $db->exec($sql);
             print("Created $table Table.\n");
        
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
         
        
    }

    public static function createFirstUser($username, $password) {
        
    }

}