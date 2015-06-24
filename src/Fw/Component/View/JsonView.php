<?php

namespace Fw\Component\Views;

use Fw\Component\Views\View;

class JsonView implements View {

    public function render($data=array()) {

        return $this->show(json_encode($data));

    }

    private function show($data) {
        echo $data;
    }

}