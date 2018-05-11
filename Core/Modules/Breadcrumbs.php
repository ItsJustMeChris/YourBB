<?php
namespace Core\Modules;
class Breadcrumbs {
    
    public static $crumbs = [];
    
    public static function register($crumb) {
        array_push(self::$crumbs, ['crumb' => $crumb]);
    }

    public static function getCrumbs() {
        return self::$crumbs;
    }
}
