<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface CollectionInterface
{
    /**
     * @author stev leibelt
     * @param mixed $data
     * @since 2013-03-12
     * @throws \InvalidArgumentException
     */
    public function push($data);

    /**
     * @author stev leibelt
     * @param mixed $data
     * @since 2013-03-12
     * @throws \InvalidArgumentException
     */
    public function pop();

    /**
     * @author stev leibelt
     * @return mixed
     * @since 2013-03-12
     */
    public function shift();

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-03-12
     */
    public function count();
}