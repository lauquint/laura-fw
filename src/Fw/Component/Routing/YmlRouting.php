<?php

class YmlRouting implements RouteParser {

    public function parseRoute($route, array $routes){

        foreach($routes as $routename => $value) {

            if ($value['route']==$route) {
                return $routename;
            }

        }

    }


}