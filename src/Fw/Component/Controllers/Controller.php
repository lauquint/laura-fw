<?php

namespace Fw\Component\Controllers;
use Fw\Component\Dispatching\HttpRequest;

interface Controller {
    public function __invoke(HttpRequest $request);
}