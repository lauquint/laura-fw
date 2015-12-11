<?php

namespace Fw\Component\Cache;

use Memcached as Mem;

class MemCached implements Cache
{
    private $memcached;

    public function __construct(Mem $a_memcashed)
    {
        $this->memcached = $a_memcashed;
    }

    public function addServer($host, $port, $weight = 0)
    {
        return $this->memcached->addServer($host, $port, $weight);
    }

    public function set($key, $content, $expiration=null)
    {
        return $this->memcached->set($key, $content, $expiration);
    }

    public function get($key)
    {
        return $this->memcached->get($key);
    }

    public function delete($key)
    {
        return $this->memcached->delete($key);
    }

    public function getKey($parameters)
    {
        return $this->memcached->getKey($parameters);
    }
}