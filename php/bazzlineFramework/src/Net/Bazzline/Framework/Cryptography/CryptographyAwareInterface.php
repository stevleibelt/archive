<?php

namespace Net\Bazzline\Framework\Cryptography;

/**
 * @author stev leibelt
 * @since 2013-03-24
 */
interface CryptographyAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Cryptography\CryptographyInterface $cryptography
     * @since 2013-03-24
     */
    public function setCryptography(CryptographyInterface $cryptography);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Cryptography\CryptographyInterface
     * @since 2013-03-24
     */
    public function getCryptography();
}