<?php

namespace Fw\Component\Controllers;
use Fw\Component\Dispatching\HttpRequest;
use Fw\Component\Databases\Database;

interface Controller {
    public function __invoke(HttpRequest $request,  Database $database);
}