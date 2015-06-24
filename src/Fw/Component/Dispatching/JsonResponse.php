<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class JsonResponse implements Response {

    public function render($data=array(), $headers=array()) {

       // $this->setheaders();

    return json_encode($data);

    }

   /* private function setheaders() {
        return 'header("Content-Type: application/json; charset=UTF-8")';
    }*/
}