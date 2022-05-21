<?php

namespace Net\Bazzline\Framework\Configuration;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
interface ConfigurationInterface
{

    /**
     * @autor stev leibelt
     * @param string $name
     * @param mixed $defaultValue
     * @since 2013-02-20
     */
    public function getParameter($name, $defaultValue = null);

    /**
     * @autor stev leibelt
     * @param array $path
     * @param mixed $defaultValue
     * @since 2013-02-20
     * @todo
     */
    public function getParameterByPath(array $path, $defaultValue = null);
}