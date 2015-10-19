<?php

namespace Fw\Component\Dispatching\Request;

use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\Request\ArrayAccessRequest;


interface Request
{
    public function __construct(ArrayAccessRequest $an_arrayAccess,  HttpDispatcher $an_httpdispatcher);
}