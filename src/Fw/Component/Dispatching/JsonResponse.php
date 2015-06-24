<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class JsonResponse implements Response {

    public function render($response) {

        $this->setheaders();

    return json_encode($response);

    }

    private function setheaders() {
        return 'header("Content-Type: application/json; charset=UTF-8")';
    }
}