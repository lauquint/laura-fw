<?php

namespace Fw\Component\Routing;

class YmlRouting implements RouteParser {

    public function parseRoute($route, array $routes)
    {
        //$routes = $this->parser->parse($this->routes);
        //$route = $this->getPath();
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($routes as $key => $value){
            if($value['route'] == $route) {

                $isAllowedMethod = $this->checkAllowedMethods($value['method'], $method);
                if(!$isAllowedMethod){
                    throw new \Exception("Denied");
                    break;
                }
                return $key;
            } elseif (preg_match('(\{(.*?)\})',$value['route']) === 1) {
                $routetocompare = preg_replace('(\{(.*?)\})', '(\w+)', $value['route']);
                $routetocompare = str_replace("/", "\\/", $routetocompare);
                if (preg_match_all("/^" . $routetocompare . "$/", $route, $matches) > 0) {
                    //var_dump($matches);
                    $values = array_splice($matches, 1);
                    foreach ($values as $v) {
                        $tmpval[] = $v[0];
                    }
                    $patterns = array_fill(0, count($tmpval), '(\{.*?\})');
                    $key = preg_replace($patterns, $tmpval, $key, 1);
                    return $key;
                }
            }
        }
        throw new \Exception("Not found!");
    }
    private function getPath()
    {
        if(isset($_SERVER['PATH_INFO']))   {
            return $_SERVER['PATH_INFO'];
        }else{
            return "/";
        }
    }
    private function checkAllowedMethods($allowed_methods, $method){
        foreach($allowed_methods as $allowed_method){
            if (strtolower($allowed_method) == strtolower($method)) {
                return true;
            }
        }
        return false;
    }


}