<?php
error_reporting(0);

require '../../vendor/autoload.php';

use Fw\Application;
use Fw\Component\Routing\PhpParser;
use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\HttpRequest;

$application= new Application;
$routing = new PhpParser();

$route = $_SERVER['PATH_INFO'];

$routes = array(
    'Home'=> array(
        'route'=>'/',
        'method'=>'get'
    ),
    'Welcome' => array(
        'route'=>'/welcome',
        'method'=>'get'),
);

if (!$route) {
    $route='/';
}

$route_name = $routing->parseRoute($route, $routes);

$controllers = array(
    'Home' => array(
        'controller'=>'App\Controller\Home'
    ),
    'Welcome'=>array(
        'controller'=>'App\Controller\Welcome'
    ),
);

$get_controller = new HttpDispatcher;
$controller = $get_controller->dispatchController($route_name, $controllers);

$controller_i = new $controller;

 //$request = new HttpRequest($_GET, $_POST, $_SERVER);

$controller_i($request);

$application->run();
