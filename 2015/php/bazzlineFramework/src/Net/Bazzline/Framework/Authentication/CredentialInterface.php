<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface CredentialInterface
{
    /**
     * @author stev leibelt
     * @param string $passphrase
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface 
     * @since 2013-03-16
     */
    public function setPassphrase($passphrase);

    /**
     * @author stev leibelt
     * @param string $salt
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface 
     * @since 2013-03-16
     */
    public function setSalt($salt);

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function getHashedPassphrase();
}