<?php

namespace Net\Bazzline\Framework\Storage;

use Net\Bazzline\Framework\Utility\Collection;
use stdClass;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class DummyStorage extends StorageAbstract
{
    /**
     * @author stev leibelt
     * @param string $statement
     * @return \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-02-24
     */
    public function fetchAll($statement)
    {
        $collection = new Collection();

        $numberOfEntries = rand(13, 42);
        $currentTime = time();
        $fifteenDaysInSeconds = 1296000;
        $startTime = $currentTime - $fifteenDaysInSeconds;
        $endTime = $currentTime + $fifteenDaysInSeconds;
        $title = array(
            'team meeting',
            'remote meeting',
            'project plan review',
            'sprint planning',
            'review/retro'
        );
        $location = array(
            'Hamburg',
            'Freiberg',
            'Ellerau',
            'Quickborn',
            'Timisoara'
        );
        for ($i = 0; $i < $numberOfEntries; $i++) {
            $event = new stdClass();

            $event->id = rand(10000, 99999);
            $event->start_time = rand($startTime, $endTime);
            $event->end_time = rand(0, 3599);
            $event->color = rand(-1, 13);
            $event->is_all_day_event = (rand(0, 10) > 8);
            $event->location = $location[rand(0, 4)];
            $event->subject = $title[rand(0, 4)];

            $collection->push($event);
        }

        return $collection;
    }

    /**
     * @author stev leibelt
     * @param string $statement
     * @since 2013-02-24
     */
    public function execute($statement)
    {
        return null;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-24
     */
    public function hasError()
    {
        return false;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getError()
    {
        return '';
    }
}