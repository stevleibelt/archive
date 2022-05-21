<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface AuthenticateInterface
{
    /**
     * @author stev leibelt
     * @return mixed (uniq identifier)
     * @since 2013-03-16
     */
    public function getIdentity();

    /**
     * @author stev leibelt
     * @since 2013-03-16
     */
    public function clearIdentity();

    /**
     * @author stev leibelt
     * @since 2013-03-16
     */
    public function hasIdentity();

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @throws \Net\Bazzline\Framework\Authentication\AuthenticationException
     */
    public function authenticate();
}