<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Model;

/**
 * Class Payload
 * @package Model
 */
class Payload implements ArrayAbleInterface
{
    /** @var array */
    private $content;

    /**
     * @param array $content
     */
    public function setContent(array $content)
    {
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->content;
    }
}