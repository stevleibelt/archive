<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface CredentialAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\CredentialInterface $credential
     * @since 2013-03-16
     */
    public function setCredential(CredentialInterface $credential);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface $credential
     * @since 2013-03-16
     */
    public function getCredential();
}