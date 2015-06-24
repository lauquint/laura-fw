<?php

namespace Fw\Component\Dispatching;

interface Response {

    public function render($data='', $headers=null);

}