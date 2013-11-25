<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-18
 */
class SHA1Credential implements CredentialInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-19
     * @var string
     */
    private $passphrase;

    /**
     * @author stev leibelt
     * @since 2013-03-19
     * @var string
     */
    private $salt;

    /**
     * @author stev leibelt
     * @param string $passphrase
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface 
     * @since 2013-03-19
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = (string) $passphrase;

        return $this;
    }

    /**
     * @author stev leibelt
     * @param string $salt
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface 
     * @since 2013-03-19
     */
    public function setSalt($salt)
    {
        $this->salt = (string) $salt;

        return $this;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-19
     */
    public function getHashedPassphrase()
    {
        return sha1($this->passphrase . $this->salt);
    }
}