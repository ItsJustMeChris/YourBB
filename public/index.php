<?php
require '../vendor/autoload.php';

Twig_Autoloader::register();

\Core\Session::init();

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

$router = new Core\Router();

$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('{controller}/{id:[\s\S]+}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);
