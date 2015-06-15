<?php

namespace Fw\Routing;


class PhpParser implements RouteParser {

    private $routes;

    public function returnRouteName(){

        $routes = file_get_contents('../../src/config/routes.php');


    }

}

