<?php
namespace YourBB\Controllers;
use YourBB\Classes\Database as db;
use YourBB\Classes\Controller as Controller;
use YourBB\Models\AuthModel as auth;

class AuthController extends Controller
{
    public static function logout() {
        return auth::logout();
    }

    public static function login()
    {
        return auth::login($_POST);
    }

    public static function register()
    {
        return auth::register($_POST);
    }
}
