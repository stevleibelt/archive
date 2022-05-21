<?php

namespace Net\Bazzline\Framework\Application;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
interface ApplicationInterface
{
    /**
     * @author stev leibelt
     * @return Net\Bazzline\Framework\Application\Application
     * @since 2013-02-19
     */
    public static function create();

    /**
     * @author stev leibelt
     * @since 2013-02-19
     */
    public function andRun();
}