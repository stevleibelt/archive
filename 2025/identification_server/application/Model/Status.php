<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Model;

/**
 * Class Status
 * @package Model
 */
class Status
{
    /** @var int */
    private $code;

    /** @var string */
    private $message;

    public function __construct()
    {
        $this->code = 0;
        $this->message = 'ok';
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = (int) $code;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'code' => $this->code,
            'message' => $this->message
        );
    }
} 