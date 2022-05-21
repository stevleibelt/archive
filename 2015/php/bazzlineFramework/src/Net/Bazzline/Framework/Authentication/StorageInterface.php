<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-18
 */
interface StorageInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\IdentitiyInterface $identity
     * @param \Net\Bazzline\Framework\Authentication\CredentialInterface $credential
     * @return mixed (uniq identifier ($id) of current record)
     * @since 2013-03-18
     * @throws \Net\Bazzline\Framework\Authentication\AuthenticationException
     */
    public function findOne(IdentitiyInterface $identity, CredentialInterface $credential);
}