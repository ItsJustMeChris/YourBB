<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('VIEWS_PATH', __DIR__.'/src/Views/');
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/routes.php';

?>
