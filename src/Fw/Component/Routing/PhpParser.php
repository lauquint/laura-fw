<?php

namespace Fw\Routing;


class PhpParser implements RouteParser {

    private $routes;

    public function returnRouteName(){

        $this->routes = file_get_contents('../../src/config/routes.php');


    }

}

