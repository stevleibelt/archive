<?php

namespace Storage;

use Net\Bazzline\Framework\Storage\DataMapperAbstract;
use Net\Bazzline\Framework\Model\ModelInterface;
use Model\Authenticate;
use Net\Bazzline\Framework\Utility\Collection;

/**
 * @author stev leibelt
 * @since 2013-03-10
 */
class AuthenticateDataMapper extends DataMapperAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-12
     * @var string
     */
    private $tableName;

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return array
     * @since 2013-03-12
     */
    public function find(ModelInterface $model)
    {
        $statement = $this->prepareFindStatement($model);

        $entries = $this->getServiceManager()->getStorage()->fetchAll($statement);
        $collection = new EventCollection();

        foreach($entries as $entry) {
            $collection->add($this->buildEvent($entry));
        }

        return $collection;
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return \Model\Event
     * @since 2013-02-21
     */
    public function findOne(ModelInterface $model)
    {
        $statement = $this->prepareFindStatement($model);
        $statement .= ' LIMIT 1';

        $entry = $this->getServiceManager()->getStorage()->fetchAll($statement);
        $result = (is_null($entry)) ? null : $this->buildEvent($entry);

        return $result;
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return count
     * @since 2013-02-21
     */
    public function count(ModelInterface $model)
    {
        $statement = $this->prepareFindStatement($model);

        $count = $this->getServiceManager()->getStorage()->count($statement);

        return $count;
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return \Model\Event
     * @since 2013-02-21
     * @todo implement
     */
    public function store(ModelInterface $model)
    {
        $statement = $this->prepareStoreStatement($model);

        $result = $this->getServiceManager()->getStorage()->execute($statement);
        if ($this->getServiceManager()->getStorage()->hasError()) {
            echo $this->getServiceManager()->getStorage()->getError() . PHP_EOL;
        }

        return $result;
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return \Model\Event
     * @since 2013-02-21
     * @todo implement
     */
    public function remove(ModelInterface $model)
    {
        $statement = 'DELETE FROM `' . $this->getTableName() . '` WHERE id = ' . $model->getId();

        return $this->getServiceManager()->getStorage()->execute($statement);
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return string
     * @since 2013-03-10
     */
    private function prepareStoreStatement(ModelInterface $event)
    {
        $statement = 'INSERT INTO `' . $this->getTableName() . '` ';

        $columns = array();
        $values = array();

        if (!is_null($event->getColor())) {
            $columns[] = 'color';
            $values[] = '\'' . $event->getColor() . '\'';
        }
        if (!is_null($event->getDescription())) {
            $columns[] = 'description';
            $values[] = '\'' . $event->getDescription() . '\'';
        }
        if (!is_null($event->getEndTime())) {
            $columns[] = 'end_time';
            $values[] = '\'' . $event->getEndTime() . '\'';
        }
        if (!is_null($event->getGroupId())) {
            $columns[] = 'group_id';
            $values[] = (integer) $event->getGroupId();
        }
        if (!is_null($event->getIsAllDayEvent())) {
            $columns[] = 'is_all_day_event';
            $values[] = ($event->getIsAllDayEvent() > 0) ? 1 : 0;
        }
        if (!is_null($event->getLocation())) {
            $columns[] = 'location';
            $values[] = '\'' . $event->getLocation() . '\'';
        }
        if (!is_null($event->getStartTime())) {
            $columns[] = 'start_time';
            $values[] = '\'' . $event->getStartTime() . '\'';
        }
        if (!is_null($event->getSubject())) {
            $columns[] = 'subject';
            $values[] = '\'' . $event->getSubject() . '\'';
        }
        if (!is_null($event->getUserId())) {
            $columns[] = 'user_id';
            $values[] = (integer) $event->getUserId();
        }

        $statement .= '(';

        foreach ($columns as $column) {
            $statement .= '`' . $column . '`, ';
        }
        //remove last ', '
        $statement = substr($statement, 0, -2);
        $statement .= ') VALUES (';

        foreach ($values as $value) {
            $statement .= $value . ', ';
        }
        //remove last ', '
        $statement = substr($statement, 0, -2);
        $statement .= ')';

        if (!is_null($event->getId())) {
            $statement .= ' WHERE `id` = ' . (integer) $event->getId();
        }

        return $statement;
    }

    /**
     * @author stev leibelt
     * @param \Model\Event $event
     * @return string
     * @since 2013-02-24
     */
    private function prepareFindStatement(ModelInterface $event)
    {
        $statement = 'SELECT * FROM `' . $this->getTableName() . '` as `e` WHERE ';

        if (!is_null($event->getColor())) {
            $statement .= '`e`.`color` = ' . $event->getColor();
        }
        if (!is_null($event->getDescription())) {
            $statement .= '`e`.`description` like \'' . $event->getDescription() . '\'';
        }
        if (!is_null($event->getEndTime())) {
            $statement .= '`e`.`end_time` = ' . $event->getEndTime();
        }
        if (!is_null($event->getGroupId())) {
            $statement .= '`e`.`group_id` = ' . $event->getGroupId();
        }
        if (!is_null($event->getId())) {
            $statement .= '`e`.`id` = \'' . $event->getId() . '\'';
        }
        if (!is_null($event->getIsAllDayEvent())) {
            $statement .= '`e`.`is_all_day_event` = ' . $event->getIsAllDayEvent();
        }
        if (!is_null($event->getLocation())) {
            $statement .= '`e`.`location` = \'' . $event->getLocation() . '\'';
        }
        if (!is_null($event->getStartTime())) {
            $statement .= '`e`.`start_time` = ' . $event->getStartTime();
        }
        if (!is_null($event->getSubject())) {
            $statement .= '`e`.`subject` like \'' . $event->getSubject() . '\'';
        }
        if (!is_null($event->getUserId())) {
            $statement .= '`e`.`user_id` = ' . $event->getUserId();
        }

        return $statement;
    }

    /**
     * @author stev leibelt
     * @param type $entry
     * @return \Model\Event
     * @since 2013-02-24
     * @todo implement
     */
    private function buildEvent($entry)
    {
        $event = new Event();

        if (is_object($event)) {
            if (isset($entry->color)) {
                $event->setColor($entry->color);
            }
            if (isset($entry->description)) {
                $event->setDescription($entry->description);
            }
            if (isset($entry->end_time)) {
                $event->setEndTime($entry->end_time);
            }
            if (isset($entry->group_id)) {
                $event->setGroupId($entry->group_id);
            }
            if (isset($entry->id)) {
                $event->setId($entry->id);
            }
            if (isset($entry->is_all_day_event)) {
                $event->setIsAllDayEvent($entry->is_all_day_event);
            }
            if (isset($entry->location)) {
                $event->setLocation($entry->location);
            }
            if (isset($entry->start_time)) {
                $event->setStartTime($entry->start_time);
            }
            if (isset($entry->subject)) {
                $event->setSubject($entry->subject);
            }
            if (isset($entry->user_id)) {
                $event->setUserId($entry->user_id);
            }
        }

        return $event;
    }


    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    private function getTableName()
    {
        if (is_null($this->tableName)) {
            $tablePrefix = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'tablePrefix'), '');

            $this->tableName = $tablePrefix . 'event';
        }

        return $this->tableName;
    }
}
