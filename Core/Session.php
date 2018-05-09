<?php
namespace Core;
class Session {

    public static function delete($key) {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    public static function destroy() {
        session_destroy();
    }

    public static function exists($key) {
        return(isset($_SESSION[$key]));
    }

    public static function get($key) {
        if (self::exists($key)) {
            return($_SESSION[$key]);
        }
    }

    public static function init() {
        if (session_id() == "") {
            session_start();
        }
    }

    public static function put($key, $value) {
        return($_SESSION[$key] = $value);
    }
}