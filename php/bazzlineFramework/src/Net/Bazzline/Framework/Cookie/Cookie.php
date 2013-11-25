<?php

namespace Net\Bazzline\Framework\Cookie;

use Net\Bazzline\Framework\Utility\ScopeArrayManager;
use Net\Bazzline\Framework\Cryptography\CryptographyInterface;
use Net\Bazzline\Framework\Cryptography\CryptographyAwareInterface;

/**
 * @author stev leibelt
 * @since 2013-03-24
 */
class Cookie extends ScopeArrayManager implements CryptographyAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-24
     */
    private $crypthography;

    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var string
     */
    private $domain;

    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var integer
     */
    private $expire;

    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var string
     */
    private $name;

    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var string
     */
    private $path;

    /**
     * @author stev leibelt
     * @param string $name
     * @param integer $expire
     * @param string $path
     * @param string $domain
     * @since 2013-03-24
     */
    public function __construct($name, $expire = null, $path = null, $domain = null)
    {
        $this->domain = (string) $domain;
        $this->name = (string) $name;
        $this->expire = (is_null($expire)) ? 0 : (integer) $expire;
        $this->path = (is_null($path)) ? '' : (string) $path;

        if (isset($_COOKIE[$this->name])) {
            $this->setArray($_COOKIE[$this->name]);
        } else {
            $this->setArray(array());
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-24
     */
    public function __destruct()
    {
        $encryptedCookie = array();
        if (!is_null($this->crypthography)) {
            foreach ($this->toArray() as $key => $value) {
                $encryptedCookie[$this->crypthography->encrypt($key)] = $this->crypthography->encrypt($value);
            }
        } else {
            $encryptedCookie = $this->toArray();
        }

        setcookie($this->name, $encryptedCookie, time() + $this->expire, $this->path, $this->domain);
    }


    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Cryptography\CryptographyInterface $cryptography
     * @since 2013-03-24
     */
    public function setCryptography(CryptographyInterface $cryptography)
    {
        $this->crypthography = $cryptography;

        if (isset($_COOKIE[$this->name])) {
            $decryptedCookie = array();
            foreach ($_COOKIE[$this->name] as $key => $value) {
                $decryptedCookie[$this->crypthography->decrypt($key)] = $this->crypthography->decrypt($value);
            }

            $this->setArray($decryptedCookie);
        }
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Cryptography\CryptographyInterface
     * @since 2013-03-24
     */
    public function getCryptography()
    {
        return $this->crypthography;
    }
}