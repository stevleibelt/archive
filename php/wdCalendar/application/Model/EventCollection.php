<?php

namespace Model;

use Net\Bazzline\Framework\Utility\Collection;

class EventCollection extends Collection
{
    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @type integer
     */
    private $endTimestamp;

    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @type array
     */
    private $errors;

    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @type boolean
     */
    private $isSorted;

    /**
     * @author stev leibelt
     * @since 2013-02-25
     * @type integer
     */
    private $startTimestamp;

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-02-25
     */
    public function getStartTimestamp()
    {
        return $this->startTimestamp;
    }

    /**
     * @author stev leibelt
     * @param integer $startTimestamp
     * @since 2013-02-25
     */
    public function setStartTimestamp($startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-25
     */
    public function setIsSorted()
    {
        $this->isSorted = true;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-25
     */
    public function setIsNotSorted()
    {
        $this->isSorted = false;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-25
     */
    public function isSorted()
    {
        return $this->isSorted;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-25
     */
    public function hasErrors()
    {
        return (count($this->errors) > 0);
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-25
     */
    public function getErrors()
    {
        return $this->errors;
    }
}