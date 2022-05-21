<?php

namespace Net\Bazzline\Framework\Cryptography;

use InvalidArgumentException;

/**
 * based on: http://www.phpsnaps.com/snaps/view/rijndael-256-bit-encryption-using-mcrypt/
 *
 * @author stev leibelt
 * @since 2013-03-24
 */
class Rijndal256 implements CryptographyInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var string 32 byte
     */
    private $key;

    /**
     * @author stev leibelt
     * @param string $key needs to have a length of 32 bytes
     * @throws InvalidArgumentException
     * @since 2013-03-24
     */
    public function __construct($key)
    {
        if (strlen($key) != 32) {
            $message = 'Invalid key provided.';

            throw new InvalidArgumentException($message);
        }

        $this->key = $key;
    }

    /**
     * @author stev leibelt
     * @param mixed $value
     * @return mixed
     * @since 2013-03-24
     */
    public function encrypt($value)
    {
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, trim($value), MCRYPT_MODE_ECB, $iv));
        $encode = base64_encode($passcrypt);

        return $encode;
    }

    /**
     * @author stev leibelt
     * @param mixed $value
     * @return mixed
     * @since 2013-03-24
     */
    public function decrypt($value)
    {
        $decoded = base64_decode($value);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, trim($decoded), MCRYPT_MODE_ECB, $iv));

        return $decrypted;
    }
}