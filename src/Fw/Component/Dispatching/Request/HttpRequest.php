<?php
namespace Fw\Component\Dispatching\Request;

use ArrayAccess;
use Fw\Component\Dispatching\HttpDispatcher;
use Fw\Component\Dispatching\Request\ArrayAccessRequest;
use Fw\Component\Dispatching\Request\Request;

class HttpRequest implements Request, ArrayAccess
{
    private $arrayAccessRequest;
    private $httpdispatcher;

    public function __construct(ArrayAccessRequest $an_arrayAccess,  HttpDispatcher $an_httpdispatcher)
    {
        $this-> arrayAccessRequest = $an_arrayAccess;
        $this-> httpdispatcher = $an_httpdispatcher;

        $this->arrayAccessRequest->container = array(
            "server" => $_SERVER,
            "get" => $_GET,
            "post" => $_POST,
            "variables" => $this->httpdispatcher->getValues()
        );
    }

    public function offsetSet($offset, $value)
    {
        return $this->arrayAccessRequest->offsetSet($offset, $value);
    }

    public function offsetExists($offset)
    {
        return $this->arrayAccessRequest->offsetExists($offset);
    }

    public function offsetUnset($offset)
    {
        return $this->arrayAccessRequest->offsetUnset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->arrayAccessRequest->offsetGet($offset);
    }
}