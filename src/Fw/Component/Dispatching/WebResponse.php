<?php

namespace Fw\Component\Dispatching;
use Fw\Component\Dispatching\Response;

class WebResponse implements Response {

    private $parameters;
    private $response;
    private $template;

    public function __construct($data=array(), $template=null) {

        $this->parameters = $data;
        $this->template = $template;
    }

    public function getResponse() {

        $this->response = array(
                                'template' => $this->template,
                                'parameters' => $this->parameters
                                );
        return $this->response;

    }
}