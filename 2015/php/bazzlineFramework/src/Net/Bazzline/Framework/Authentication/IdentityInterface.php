<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface IdentityInterface
{
    /**
     * @author stev leibelt
     * @param string $loginname
     * @since 2013-03-16
     */
    public function setLoginname($loginname);

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function getLoginname();
}