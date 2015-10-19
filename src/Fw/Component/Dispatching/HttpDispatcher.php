<?php

namespace Fw\Component\Dispatching;

class HttpDispatcher {

    private $values;

    public function getValues()
    {
        return $this->values;
    }

    public function dispatchController($route_name, array $controllers) {

        foreach($controllers as $route => $controller) {

            if ($route_name==$route) {
                echo 'here';
                return $controller['controller'];

            } else{

            preg_match_all('(\{(.*?)\})',$route, $_keyvars);
            $routetocompare=preg_replace('(\{(.*?)\})','(\w+)',$route);
            $routetocompare=str_replace("/","\\/",$routetocompare);
            if (preg_match_all("/^".$routetocompare."$/",$route_name,$matches)>0){
                $values=array_splice($matches,1);
                foreach ($values as $v)$tmpval[]=$v[0];
                $keyvars=$_keyvars[1];

                $this->values=array_combine($keyvars,$tmpval);

                return $controller["controller"];
            }
        }


        }

    }

}