<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Model;

/**
 * Class Response
 * @package Model
 */
class Response
{
    /** @var Payload */
    private $payload;

    /** @var Status */
    private $status;

    /**
     * @param Payload $payload
     */
    public function setPayload(PayLoad $payload)
    {
        $this->payload = $payload;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'status' => $this->status->toArray(),
            'payload' => $this->payload->toArray()
        );
    }
} 