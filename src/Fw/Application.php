<?php

namespace Fw;

//use Fw\Component\Routing\PhpRouting;
use Fw\Component\Routing\YmlRouting;
use Fw\Component\Routing\RouteParser;
use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\HttpRequest;
use Fw\Component\Dispatching\Request;
use Fw\Component\Dispatching\JsonResponse;
use Fw\Component\Dispatching\WebResponse;
use Fw\Component\Views\JsonView;
use Fw\Component\Views\TwigView;
use \Twig_Environment;
use Fw\Component\Databases\Database;
use Symfony\Component\Yaml\Parser;


final class Application {

    public $template_engine;
    public $database;


    public function run() {

        $routing = new YmlRouting();

        $this->setRouting($routing);

    }

    public function getRoute() {

        if (!isset($_SERVER['PATH_INFO'])) {

            $route=$_SERVER['REQUEST_URI'];

        } else {

            $route = $_SERVER['PATH_INFO'];

        }

        return $route;

    }

    public function setRouting(RouteParser $routing) {


        //include __DIR__ . '/../../../../../src/config/routes.php';
        $yaml = new Parser();
        $routes = $yaml->parse(file_get_contents(__DIR__ .'/../../../../../src/config/routes.yml'));

        $route = $this->getRoute();

        if (!$route) {
            $route='/';
        }

        $route_name = $routing->parseRoute($route, $routes);


        $get_controller = new HttpDispatcher;
        //include __DIR__ . '/../../../../../src/config/controllers.php';
        $yaml = new Parser();
        $controllers = $yaml->parse(file_get_contents(__DIR__ .'/../../../../../src/config/controllers.yml'));

        $controller = $get_controller->dispatchController($route_name, $controllers);

        $controller_i = new $controller;

        $request = new Request();

        $httprequest = new HttpRequest($request, $_GET, $_POST, $_SERVER);

        $response = $controller_i($httprequest, $this->database);

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

    public function setDatabase(Database $database) {

        $this->database = $database;
    }

}
