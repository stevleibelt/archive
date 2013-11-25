<?php

namespace Net\Bazzline\Framework\Cryptography;

/**
 * @author stev leibelt
 * @since 2013-03-24
 */
interface CryptographyInterface
{
    /**
     * @author stev leibelt
     * @param mixed $value
     * @return mixed
     * @since 2013-03-24
     */
    public function encrypt($value);

    /**
     * @author stev leibelt
     * @param mixed $value
     * @return mixed
     * @since 2013-03-24
     */
    public function decrypt($value);
}