<?php

namespace Fw\Component\Dispatching;

interface Response {

    public function __construct($data);

    public function getResponse();

}