<?php

namespace Fw\Component\Views;

use Fw\Component\Views\View;

class JsonView implements View {

    public function render($data=array()) {

        echo json_encode($data);

    }
}