<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class JsonResponse implements Response {

    public function getResponse($response=array()) {
        return $response;
    }
}