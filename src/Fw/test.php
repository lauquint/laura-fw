<?php

require '../../vendor/autoload.php';

use Fw\Application;
use Fw\Component\Routing\PhpParser;
use \Fw\Component\Dispatching\HttpDispatcher;

$application= new Application;
$routing = new PhpParser();

$route = $_SERVER['PATH_INFO'];

$routes = array(
    'home'=>array('/', 'get'),
    'welcome'=>array('/welcome', 'get'),
);

if (!$route) {
    $route='/';
}

$route_name = $routing->parseRoute($route, $routes);

$controllers = array(
    'home'=>'App\Controller\Home',
    'hello'=>'App\Controller\Welcome',
);

$get_controller = new HttpDispatcher;
$controller = $get_controller->dispatchController($route_name, $controllers);

new $controller;

$application->run();
