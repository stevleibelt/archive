<?php

namespace Net\Bazzline\Framework\Session;

/**
 * @author stev leibelt
 * @since 2013-02-21
 */
interface SessionInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function start();

    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function clean();

    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function stop();

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $value
     * @return mixed
     * @since 2013-02-22
     */
    public function setParameter($name, $value);

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     * @since 2013-02-22
     */
    public function getParameter($name, $defaultValue = null);

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $value
     * @since 2013-02-22
     */
    public function setParameterByPath(array $path, $value);

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $defaultValue
     * @since 2013-02-22
     */
    public function getParameterByPath(array $path, $defaultValue = null);
}