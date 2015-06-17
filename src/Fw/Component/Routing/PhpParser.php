<?php

namespace Fw\Component\Routing;


class PhpParser implements RouteParser {

    public function parseRoute($route, array $routes){

    foreach($routes as $routename => $value) {

        if ($value['route']==$route) {
            return $routename;
        }


    }

    }

}

