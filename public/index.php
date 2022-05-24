<?php

#header('Content-Type: application/json');

use Config\Router;

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/vendor/autoload.php';

$router = new Router;
$router->get();

if (isset($router->routes[1])) {
    $model = ucfirst($router->routes[1]);
    $router->runAction($model . '@' . $router->routes[2]);
}