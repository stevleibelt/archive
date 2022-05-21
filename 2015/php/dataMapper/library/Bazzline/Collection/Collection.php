<?php

namespace Bazzline;

class Collection implements Iterator
{
    private $collection;

    private $index;

    public function __construct(array $collection) 
    {
        $this->collection = $collection;
        $this->rewind();
    }

    public function current()
    {
        return $this->collection[$this->index];
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid() 
    {
        return array_key_exists($this->index, $this->collection);
    }

    public function rewind()
    {
        $this->index = 0;
    }
}