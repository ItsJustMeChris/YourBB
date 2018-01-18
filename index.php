<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/bootstrap.php';
define('TEMPLATES_PATH', 'src/templates/');
require_once __DIR__ . '/src/templates/index.php';
