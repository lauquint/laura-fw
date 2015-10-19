<?php

namespace Fw;

//use Fw\Component\Routing\PhpRouting;
use Fw\Component\Routing\YmlRouting;
use Fw\Component\Routing\RouteParser;
use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\Request\HttpRequest;
use Fw\Component\Dispatching\Request\ArrayAccessRequest;
use Fw\Component\Dispatching\Request\Request;
use Fw\Component\Dispatching\JsonResponse;
use Fw\Component\Dispatching\WebResponse;
use Fw\Component\Views\JsonView;
use Fw\Component\Views\TwigView;
use \Twig_Environment;
use Fw\Component\Databases\Database;
use Symfony\Component\Yaml\Parser;
use Fw\Component\Search\Search;


final class Application {

    public $template_engine;
    public $database;
    public $search_component;


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
        var_dump($route);
        return $route;


    }

    public function setRouting(RouteParser $routing) {


        $yaml = new Parser();
        $routes = $yaml->parse(file_get_contents(__DIR__ .'/../../../../../src/config/routes.yml'));

        $route = $this->getRoute();

        if (!$route) {
            $route='/';
        }

        $route_name = $routing->parseRoute($route, $routes);


        $yaml = new Parser();

        $controllers = $yaml->parse(file_get_contents(__DIR__ .'/../../../../../src/config/controllers.yml'));


        $httpDispatcher = new HttpDispatcher;



        $controller = $httpDispatcher->dispatchController($route_name, $controllers);

        $controller_i = new $controller;

        $arrayAccessRequest = new ArrayAccessRequest();

        $httprequest = new HttpRequest($arrayAccessRequest, $httpDispatcher);


        //$request = new Request();



        $cache = new \Memcached();
        $cache->addServer( 'localhost', 11211 );

        //$key = __CLASS__ ;
        $key = 'cool-key';
        $expiration_in_seconds = 5;

        //$value = $cache->get( $key );
        $value = false;
        if ( false === $value ) {

            $response = $controller_i($httprequest, $this->database, $this->search_component);

            $value = $this->setView($response);
            $cache->set( $key, $value, 0, $expiration_in_seconds);

        }

        echo $value;

    }

    private function  saveInCache($value)
    {

    }


    public function setView($response) {

        if ($response instanceof JsonResponse) {

            $json = new JsonView();

            $json->render($response->getResponse());


        } else if ($response instanceof WebResponse) {

            $web_view = new TwigView($this->template_engine);

            return $web_view->render($response->getResponse());

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

    public function setSearchComponent(Search $search_component)
    {
        $this->search_component = $search_component;
    }

}
