<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

namespace Model;

/**
 * Class Hasher
 * @package Model
 */
class Hasher
{
    /** @var string */
    private $salt;

    /**
     * @param string $salt
     */
    public function __construct($salt = '')
    {
        $this->salt = (string) $salt;
    }

    /**
     * @param string $string
     * @return string
     */
    public function hash($string)
    {
        return (sha1($this->salt . sha1($string)));
    }
} 