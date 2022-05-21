<?php

namespace Net\Bazzline\Framework\Utility;

use Iterator;

/**
 * @author stev leibelt
 * @since 2013-02-25
 */
class Collection implements CollectionInterface, Iterator
{
    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @var array
     */
    private $collection;

    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @var integer
     */
    private $position;

    /**
     * @author stev leibelt
     * @since 2013-02-25
     */
    public function __construct()
    {
        $this->collection = array();
        $this->rewind();
    }

    /**
     * @author stev leibelt
     * @since 2013-02-25
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @authors stev leibelt
     * @return mixed
     * @since 2013-02-25
     */
    public function current()
    {
        return ($this->valid())
            ? $this->collection[$this->position] : null;
    }

    /**
     * @authors stev leibelt
     * @return mixed
     * @since 2013-02-25
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @authors stev leibelt
     * @return mixed
     * @since 2013-02-25
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @authors stev leibelt
     * @return boolean
     * @since 2013-02-25
     */
    public function valid()
    {
        return isset($this->collection[$this->position]);
    }

    /**
     * @author stev leibelt
     * @param mixed $data
     * @since 2013-02-25
     */
    public function push($data)
    {
        if (!is_null($data)) {
            $this->collection[] = $data;
        }
    }

    /**
    * @author stev leibelt
    * @return mixed
    * @since 2013-03-12
    */
    public function shift()
    {
        $this->rewind();

        return array_shift($this->collection);
    }

    /**
     * @author stev leibelt
     * @return mixed
     * @since 2013-03-12
     */
    public function pop()
    {
        return array_pop($this->collection);
    }

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-03-12
     */
    public function count()
    {
        return count($this->collection);
    }
}
