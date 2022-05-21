<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface IdentitiyAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\IdentitiyInterface $identitiy
     * @since 2013-03-16
     */
    public function setIdentity(IdentitiyInterface $identitiy);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\IdentitiyInterface
     * @since 2013-03-16
     */
    public function getIdentitiy();
}