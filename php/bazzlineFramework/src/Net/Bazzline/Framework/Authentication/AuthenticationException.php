<?php

namespace Net\Bazzline\Framework\Authentication;

use Exception;

/**
 * @author stev leibelt
 * @since 2013-03-18
 */
class AuthenticationException extends Exception
{
    /**
     * @author stev leibelt
     * @type integer
     * @since 2013-03-18
     */
    const ERROR_CODE_AUTHENTICATION_IDENTITY_INVALID = 0;

    /**
     * @author stev leibelt
     * @type integer
     * @since 2013-03-18
     */
    const ERROR_CODE_AUTHENTICATION_CREDENTIAL_INVALID = 1;

    /**
     * @author stev leibelt
     * @type integer
     * @since 2013-03-18
     */
    const ERROR_CODE_AUTHENTICATION_UNKNOW_ERROR = 2;
}