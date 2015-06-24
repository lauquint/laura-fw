<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class JsonResponse implements Response {

    public  $response;

    public function __construct($data=array()) {

        $this->response = $data;
    }

    public function getResponse() {

        return $this->response;

    }
}


/* private function setheaders() {
     return 'header("Content-Type: application/json; charset=UTF-8")';
 }*/

// $headers=array()