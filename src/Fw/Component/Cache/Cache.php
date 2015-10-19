<?php

namespace Fw\Component\Cache;

interface Cache
{
    public function set($key, $content, $expiration);
    public function get($key);
    public function delete($key);
    public function getKey($parameters);
}