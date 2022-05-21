<?php

namespace Net\Bazzline\Framework\Cache;

/**
 * @author stev leibelt
 * @todo implement time based caching
 * @since 2013-02-24
 */
class FileCacheManager extends CacheManagerAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var string
     */
    private $path;

    /**
     * @author stev leibelt
     * @param name $key
     * @return boolean
     * @since 2013-02-24
     */
    public function exist($key)
    {
        return file_exists($this->getPath() . DIRECTORY_SEPARATOR . $key);
    }

    /**
     * @author stev leibelt
     * @param string $key
     * @return mixed
     * @since 2013-02-24
     */
    public function retrieve($key)
    {
        return ($this->exist($key)) ?
            unserialize(file_get_contents($this->getPath() . DIRECTORY_SEPARATOR . $key)) : null;
    }

    /**
     * @author stev leibelt
     * @param string $key
     * @param mixed $value
     * @param integer $time
     * @return int or false
     */
    public function store($key, $value, $time = null)
    {
        $this->remove($key);

        return file_put_contents($this->getPath() . DIRECTORY_SEPARATOR . $key, serialize($value));
    }

    /**
     * @author stev leibelt
     * @param string $key
     * @return boolean
     * @since 2013-03-16
     */
    public function remove($key) 
    {
        return ($this->exist($key)) ? 
            unlink($this->getPath() . DIRECTORY_SEPARATOR . $key) : true;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-24
     */
    private function getPath()
    {
        if (is_null($this->path)) {
            $this->path = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('cache', 'path'), '/tmp');
        }

        return $this->path;
    }
}