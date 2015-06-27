<?php

namespace Fw;

use Fw\Component\Routing\PhpParser;
use Fw\Component\Routing\RouteParser;
use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\HttpRequest;
use Fw\Component\Dispatching\Request;
use Fw\Component\Dispatching\JsonResponse;
use Fw\Component\Dispatching\WebResponse;
use Fw\Component\Views\JsonView;
use Fw\Component\Views\TwigView;
use \Twig_Environment;

final class Application {

    public $template_engine;


    public function run() {

        $routing = new PhpParser();

        $this->setRouting($routing);

    }

    public function setRouting(RouteParser $routing) {

        if (!isset($_SERVER['PATH_INFO'])) {
            $route=$_SERVER['REQUEST_URI'];
        } else {
            $route = $_SERVER['PATH_INFO'];
        }


        $routes = array(
            'Home'=> array(
                'route'=>'/',
                'method'=>'get'
            ),

            'Welcome' => array(
                'route'=>'/welcome',
                'method'=>'get'
            ),
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
            )
        );


        $get_controller = new HttpDispatcher;

        $controller = $get_controller->dispatchController($route_name, $controllers);

        $controller_i = new $controller;

        $request = new Request();
        $httprequest = new HttpRequest($request, $_GET, $_POST, $_SERVER);

        $response = $controller_i($httprequest);

        $this->setView($response);


    }

    public function setView($response) {

        if ($response instanceof JsonResponse) {

            $json = new JsonView();

            $json->render($response->getResponse());


        } else if ($response instanceof WebResponse) {

            $web_view = new TwigView($this->template_engine);

            $web_view->render($response->getResponse());

        }

    }

    public function setTemplateEngine($templateEngine) {

        if ($templateEngine instanceof Twig_Environment) {

            $this->template_engine = $templateEngine;

        }

    }
}
