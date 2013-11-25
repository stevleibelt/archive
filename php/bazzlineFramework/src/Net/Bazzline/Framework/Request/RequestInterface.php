<?php

namespace Net\Bazzline\Framework\Request;

/**
 * @author stev leibelt
 * @since 2013-02-16
 */
interface RequestInterface
{
    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-16
     */
    public function getParameters();

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-16
     */
    public function getParameter($name, $default = null);
}
