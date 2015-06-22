<?php

namespace Fw\Component\Dispatching;

use ArrayAccess;

class Request implements ArrayAccess {

    private $container = array();


    public function __construct($get, $post, $session) {
        $this->container = array(
            "get"   => $get,
            "post"   => $post,
            "session" => $session,
        );
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}

