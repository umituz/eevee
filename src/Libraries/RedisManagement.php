<?php

namespace GreatPackage\Libraries;

use Illuminate\Support\Facades\Redis;

/**
 * Class RedisManagement
 * @package GreatPackage\Libraries
 */
class RedisManagement
{
    private $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**,
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $value = serialize($value);

        $this->redis->set($key, $value);

        return $this;
    }

    /**
     * @param $group
     * @param $key
     * @return mixed
     */
    public function hGet($group, $key)
    {
        return unserialize($this->redis->hget($group, $key));
    }

    /**
     * @param $group
     * @param $key
     * @param $value
     * @return $this
     */
    public function hSet($group, $key, $value)
    {
        $value = serialize($value);

        $this->redis->hset($group, $key, $value);

        return $this;
    }
}
