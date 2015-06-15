<?php

namespace Fw\Component\Dispatching;

class HttpDispatcher {

    public function dispatchController ($route_name, array $controllers) {

        foreach($controllers as $route => $controller) {

            if ($route_name==$route) {
                return $controller;
            }


        }

    }

}