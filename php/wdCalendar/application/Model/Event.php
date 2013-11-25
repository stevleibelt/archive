<?php

namespace Model;

use Net\Bazzline\Framework\Model\Model;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
class Event extends Model
{
    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $subject;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $starttime;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $endtime;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var boolean
     */
    private $isAllDayEvent;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $description;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $location;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var integer
     */
    private $color;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var integer
     */
    private $userId;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var integer
     */
    private $groupId;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var string 
     */
    private $timezone;

    /**
     * @author stev leibelt
     * @param integer $color
     * @since 2013-02-24
     */
    public function setColor($color)
    {
        $this->color = (integer) $color;
    }

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-02-24
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @author stev leibelt
     * @param integer $userId
     * @since 2013-02-24
     */
    public function setUserId($userId)
    {
        $this->userId = (integer) $userId;
    }

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-02-24
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @author stev leibelt
     * @param integer $groupId
     * @since 2013-02-24
     */
    public function setGroupId($groupId)
    {
        $this->groupId = (integer) $groupId;
    }

    /**
     * @author stev leibelt
     * @return integer
     * @since 2013-02-24
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @author stev leibelt
     * @param string $description
     * @since 2013-02-24
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @author stev leibelt
     * @param string $endTime
     * @since 2013-02-24
     */
    public function setEndTime($endTime)
    {
        $this->endtime = (string) $endTime;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getEndTime()
    {
        return $this->endtime;
    }

    /**
     * @author stev leibelt
     * @param string $startTime
     * @since 2013-02-24
     */
    public function setStartTime($startTime)
    {
        $this->starttime = (string) $startTime;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getStartTime()
    {
        return $this->starttime;
    }

    /**
     * @author stev leibelt
     * @param string $location
     * @since 2013-02-24
     */
    public function setLocation($location)
    {
        $this->location = (string) $location;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @author stev leibelt
     * @param boolean $isAllDayEvent
     * @since 2013-02-24
     */
    public function setIsAllDayEvent($isAllDayEvent)
    {
        $this->isAllDayEvent = (boolean) $isAllDayEvent;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-24
     */
    public function getIsAllDayEvent()
    {
        return $this->isAllDayEvent;
    }

    /**
     * @author stev leibelt
     * @param string $subject
     * @since 2013-02-20
     */
    public function setSubject($subject)
    {
        $this->subject = (string) $subject;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-20
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @author stev leibelt
     * @param string $timezone
     * @since 2013-03-16
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}