<?php
namespace YourBB\Controllers;
use YourBB\Classes\Controller as Controller;
use YourBB\Classes\Database as db;
use YourBB\Classes\View as view;

class ForumController extends Controller
{
    public static function create()
    {
        $forumName = db::escape($_POST['forumname']);
        $forumDescription = db::escape($_POST['forumdescription']);

        db::query("INSERT INTO forums (name, description) VALUES ('$forumName', '$forumDescription')");
    }

    public static function list()
    {
        $result = db::query("SELECT * FROM `forums`");
        if ($result->num_rows > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                $resultset[] = $row;
            }
            return $resultset;
        }
    }

    public static function view($params)
    {
        if (!isset($params[2])) {
            die("Forum doesn't exist");
        }
        $forumID = intval($params[2]);
        $result = db::query("SELECT * FROM `forums` WHERE `id`='$forumID'");
        if ($result->num_rows > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                echo $row['id'];
                $resultset[] = $row;
            }
            return $resultset;
        }
    }
}
