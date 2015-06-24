<?php

namespace Fw\Component\Dispatching;

class HttpRequest  {

    public function __construct(Request $request, $get, $post, $session) {

        $request->container = array(
            "get"   => $get,
            "post"   => $post,
            "session" => $session,
        );
    }
}