<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class JsonResponse implements Response {

    public function render($response) {

    return json_encode($response);

    }
}