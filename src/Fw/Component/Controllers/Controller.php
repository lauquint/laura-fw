<?php

namespace Fw\Component\Controllers;
use Fw\Component\Dispatching\Request\Request;
use Fw\Component\Databases\Database;
use Fw\Component\Search\Search;

interface Controller {
    public function __invoke(Request $request,  Database $database, Search $search);
}