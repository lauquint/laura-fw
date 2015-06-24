<?php

namespace Fw\Component\View;
use Fw\Component\View\View;

class JsonView implements View {

    public function render($data=array(), $headers=array()) {

        // $this->setheaders();

        return json_encode($data);

    }

    /* private function setheaders() {
         return 'header("Content-Type: application/json; charset=UTF-8")';
     }*/
}