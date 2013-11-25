<?php

namespace Net\Bazzline\Framework\Cache;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
interface CacheManagerInterface
{
    /**
     * @author stev leibelt
     * @param string key $key
     * @return boolean
     * @since 2013-02-24
     */
    public function exist($key);

    /**
     * @author stev leibelt
     * @param string $key
     * @param mixed $value
     * @param integer $time
     * @since 2013-02-24
     */
    public function store($key, $value, $time);

    /**
     * @author stev leibelt
     * @param string $key
     * @since 2013-02-24
     */
    public function retrieve($key);

    /**
     * @author stev leibelt
     * @param string $key
     * @since 2013-03-16
     */
    public function remove($key);
}