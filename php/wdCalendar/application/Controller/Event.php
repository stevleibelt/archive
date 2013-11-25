<?php

namespace Controller;

use Net\Bazzline\Framework\Controller\ControllerAbstract;
use Storage\EventDataMapper;
use Model\Event as EventModel;

/**
* @author stev leibelt
* @since 2013-02-18
*/
class Event extends ControllerAbstract
{
    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function listAction()
    {
        $day = $this->getServiceManager()->getRequest()->getParameter('showdate');
        $type = $this->getServiceManager()->getRequest()->getParameter('viewtype');
        $timezone = $this->getServiceManager()->getRequest()->getParameter('timezone');
        $phpTime = $this->js2PhpTime($day);

        $cacheKeyEvents = __CLASS__ . '-events';
        $return = $this->getServiceManager()->getCacheManager()->retrieve($cacheKeyEvents);

        if (is_null($return)) {
            $eventDataMapper = new EventDataMapper();
            $eventDataMapper->setServiceManager($this->getServiceManager());
            $event = new EventModel();
            $events = $eventDataMapper->find($event);

            $return = array(
                'events' => array(),
                'issort' => false,
                'start' => time(),
                'end' => time(),
                'error' => null
            );

            foreach ($events as $event) {
                $return['events'][] = array(
                    $event->getId(),
                    $event->getSubject(),
                    $this->php2JsTime($event->getStartTime()),
                    $this->php2JsTime($event->getEndTime()),
                    rand(0,1),
                    $event->getIsAllDayEvent(),
                    0,//Recurring event
                    $event->getColor(),
                    1, //editable
                    $event->getLocation(),
                    ''//$attends
                );
                if ($return['start'] > $this->php2JsTime($event->getStartTime())) {
                    $return['start'] = $this->php2JsTime($event->getStartTime());
                }
                if ($return['end'] < $this->php2JsTime($event->getEndTime())) {
                    $return['end'] = $this->php2JsTime($event->getEndTime());
                }
            }

           $this->getServiceManager()->getCacheManager()->store($cacheKeyEvents, $return);
        }

        return $this->returnJsonData($return);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function addAction()
    {
        $cacheKeyEvents = __CLASS__ . '-events';
        $this->getServiceManager()->getCacheManager()->remove($cacheKeyEvents);

        $calendarStartTime = $this->getServiceManager()->getRequest()->getParameter('CalendarStartTime');
        $calendarEndTime = $this->getServiceManager()->getRequest()->getParameter('CalendarEndTime');
        $calendarTitle = $this->getServiceManager()->getRequest()->getParameter('CalendarTitle');
        $isAllDayEvent = $this->getServiceManager()->getRequest()->getParameter('IsAllDayEvent');

        $event = new EventModel();
        $event->setStartTime($calendarStartTime);
        $event->setEndTime($calendarEndTime);
        $event->setSubject($calendarTitle);
        $event->setIsAllDayEvent($isAllDayEvent);

        $dataMapper = new \Storage\EventDataMapper();
        $dataMapper->setServiceManager($this->getServiceManager());

        $ret = array();

        $ret['IsSuccess'] = true;
        $ret['Msg'] = $dataMapper->store($event);
        $ret['Data'] = strtotime($event->getStartTime());

        return $this->returnJsonData($ret);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function addDetailAction()
    {
        $cacheKeyEvents = __CLASS__ . '-events';
        $this->getServiceManager()->getCacheManager()->remove($cacheKeyEvents);

        $eventId = $this->getServiceManager()->getRequest()->getParameter('calendarId');
        $subject = $this->getServiceManager()->getRequest()->getParameter('Subject');
        $isAllDayEvent = $this->getServiceManager()->getRequest()->getParameter('IsAllDayEvent');
        $description = $this->getServiceManager()->getRequest()->getParameter('Description');
        $location = $this->getServiceManager()->getRequest()->getParameter('Location');
        $colorValue = $this->getServiceManager()->getRequest()->getParameter('colorvalue');
        $timezone = $this->getServiceManager()->getRequest()->getParameter('timezone');

        $dataMapper = new \Storage\EventDataMapper();
        $dataMapper->setServiceManager($this->getServiceManager());

        $event = new EventModel();
        $event->setId($eventId);
        $eventFromDatabase = $dataMapper->findOne($event);

        $ret = array();
        if (!is_null($eventFromDatabase)) {
            $ret['IsSuccess'] = true;
            $eventFromDatabase->setSubject($subject);
            $eventFromDatabase->setIsAllDayEvent($isAllDayEvent);
            $eventFromDatabase->setDescription($description);
            $eventFromDatabase->setLocation($location);
            $eventFromDatabase->setColor($colorValue);
            $eventFromDatabase->setTimezone($timezone);
            $ret['Msg'] = $dataMapper->store($eventFromDatabase);
        } else {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = 'no entry found for given id.';
        }
        $ret['Data'] = strtotime($event->getStartTime());

        return $this->returnJsonData($ret);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function updateAction()
    {
        $cacheKeyEvents = __CLASS__ . '-events';
        $this->getServiceManager()->getCacheManager()->remove($cacheKeyEvents);

        $eventId = $this->getServiceManager()->getRequest()->getParameter('calendarId');
        $calendarStartTime = $this->getServiceManager()->getRequest()->getParameter('CalendarStartTime');
        $calendarEndTime = $this->getServiceManager()->getRequest()->getParameter('CalendarEndTime');

        $dataMapper = new \Storage\EventDataMapper();
        $dataMapper->setServiceManager($this->getServiceManager());

        $event = new EventModel();
        $event->setId($eventId);
        $eventFromDatabase = $dataMapper->findOne($event);

        $ret = array();
        if (!is_null($eventFromDatabase)) {
            $ret['IsSuccess'] = true;
            $eventFromDatabase->setStartTime($calendarStartTime);
            $eventFromDatabase->setEndTime($calendarEndTime);
            $ret['Msg'] = $dataMapper->store($eventFromDatabase);
        } else {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = 'no entry found for given id.';
        }
        $ret['Data'] = strtotime($event->getStartTime());

        return $this->returnJsonData($ret);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function updateDetailAction()
    {
        $cacheKeyEvents = __CLASS__ . '-events';
        $this->getServiceManager()->getCacheManager()->remove($cacheKeyEvents);

        $eventId = $this->getServiceManager()->getRequest()->getParameter('calendarId');
        $subject = $this->getServiceManager()->getRequest()->getParameter('Subject');
        $isAllDayEvent = $this->getServiceManager()->getRequest()->getParameter('IsAllDayEvent');
        $description = $this->getServiceManager()->getRequest()->getParameter('Description');
        $location = $this->getServiceManager()->getRequest()->getParameter('Location');
        $colorValue = $this->getServiceManager()->getRequest()->getParameter('colorvalue');
        $timezone = $this->getServiceManager()->getRequest()->getParameter('timezone');

        $dataMapper = new \Storage\EventDataMapper();
        $dataMapper->setServiceManager($this->getServiceManager());

        $event = new EventModel();
        $event->setId($eventId);
        $eventFromDatabase = $dataMapper->findOne($event);

        $ret = array();
        if (!is_null($eventFromDatabase)) {
            $ret['IsSuccess'] = true;
            $eventFromDatabase->setSubject($subject);
            $eventFromDatabase->setIsAllDayEvent($isAllDayEvent);
            $eventFromDatabase->setDescription($description);
            $eventFromDatabase->setLocation($location);
            $eventFromDatabase->setColor($colorValue);
            $eventFromDatabase->setTimezone($timezone);
            $ret['Msg'] = $dataMapper->store($eventFromDatabase);
        } else {
            $ret['IsSuccess'] = false;
            $ret['Msg'] = 'no entry found for given id.';
        }
        $ret['Data'] = strtotime($event->getStartTime());

        return $this->returnJsonData($ret);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-16
     */
    public function removeAction()
    {
        $cacheKeyEvents = __CLASS__ . '-events';
        $this->getServiceManager()->getCacheManager()->remove($cacheKeyEvents);

        $eventId = $this->getServiceManager()->getRequest()->getParameter('calendarId');

        $dataMapper = new \Storage\EventDataMapper();
        $dataMapper->setServiceManager($this->getServiceManager());

        $event = new EventModel();
        $event->setId($eventId);

        $ret = array();
        $ret['IsSuccess'] = $dataMapper->remove($event);
        $ret['Msg'] = 'Succefully';

        return $this->returnJsonData($ret);
    }

    /**
     * @author stev leibelt
     * @param mixed $data
     * @return array
     * @since 2013-02-23
     */
    private function returnJsonData($data)
    {
        $this->getServiceManager()->getLayout()->disableLayout();

        return array('data' => json_encode($data));
    }

    /**
     * @author stev leibelt
     * @param string $phpDate
     * @return string
     * @since 2013-02-23
     * @todo replace original code with DateTime
     */
    private function php2JsTime($phpDate)
    {
        return date('m/d/Y H:i', strtotime($phpDate));
    }

    /**
     * @author stev leibelt
     * @param string $phpDate
     * @return string
     * @since 2013-02-23
     * @todo replace original code with DateTime
     */
    private function js2PhpTime($jsdate)
    {
        $ret = '';

        if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
            $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
            //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
        }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
            $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
            //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
        }

      return $ret;
    }
}