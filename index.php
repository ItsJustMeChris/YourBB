<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/bootstrap.php';
define('TEMPLATES_PATH', 'src/templates/');
$params = explode("/", $_GET['query']);
// [0] = VMC [1] = action [2] = params
// users/auth/register
// users/view/user
if ($params[0] == "")
{
    $params[0] = "index";
}
$controllerName = '\YourBB\Controllers\\'.ucfirst($params[0]).'Controller';
$modelName = '\YourBB\Models\\'.ucfirst($params[0]).'Model';
if (!class_exists($controllerName) || !class_exists($modelName)) {
    die("MVC Error!");
}
$model = new $modelName();
$controller = new $controllerName($model);
$view = new \YourBB\Views\View($controller, $model);

if (isset($params[1])) {
    $controller->{$params[1]}();
}
echo $view->output();
