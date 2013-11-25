<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Session\Session;

/**
 * @author stev leibelt
 * @since 2013-03-17
 */
class SessionFactoryService extends ServiceAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-17
     * @var \Net\Bazzline\Framework\Session\SessionInterface
     */
    private static $sessionInstance;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Session\SessionInterface
     * @since 2013-03-17
     */
    public function getService()
    {
        if (is_null(self::$sessionInstance)) {

            self::$sessionInstance = new Session();

            self::$sessionInstance->start();
        }

        return self::$sessionInstance;
    }
}