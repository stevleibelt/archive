<?php

namespace Bazzline;

/**
 * Abstract class for data mapper object.
 * This class shows how to define properties and has all available criterias in.
 * 
 * @author stev leibelt
 * @since 2012-09-09
 */
abstract class AbstractDataMapper
{
    /** @var int */
    const PROPERTIE_ID = 0;

    /** @var int */
    const CRITERIA_LESS = 0;

    /** @var int */
    const CRITERIA_LESS_OR_EQUAL = 1;

    /** @var int */
    const CRITERIA_EQUAL = 2;

    /** @var int */
    const CRITERIA_GREATER_OR_EQUAL = 3;

    /** @var int */
    const CRITERIA_GREATER = 4;

    /** @var int */
    const CRITERIA_LIKE = 5;
    
    /** @var dataMapper */
    private static $__instances;

    /**
     * Constructor for class.
     * 
     * @author stev leibelt
     * @since 2012-09-09
     */
    private function __construct() {}

    /**
     * Clone method for class.
     * 
     * @author stev leibelt
     * @since 2012-09-09
     */
    private function __clone() {}

    /**
     * Destructor for class.
     * 
     * @author stev leibelt
     * @since 2012-09-09
     */
    private function __destruct() {}

    /**
     * Singletone implementation.
     * 
     * @author stev leibelt
     * @return DataMapper
     * @since 2012-09-09
     */
    static public function getInstance()
    {
        if (!isset(self::$__instances)) 
        {
            self::$__instances = new self();
        }

        return self::$__instances;
    }

    /**
     * Stores data object on storage.
     * 
     * @author stev leibelt
     * @param DataObject
     * @return DataObject
     * @since 2012-09-09
     */
    abstract public function store(DataObject $dataObject);

    /**
     * Removes data object from storage.
     * 
     * @author stev leibelt
     * @param DataObject
     * @return DataObject
     * @since 2012-09-09
     */
    abstract public function remove(DataObject $dataObject);

    /**
     * Searchs on storage for matching data objects.
     * 
     * @author stev leibelt
     * @return DataObjectCollection
     * @since 2012-09-09
     */
    abstract public function find();

    /**
     * Searchs on storage for matching data objects and returns first matching.
     * 
     * @author stev leibelt
     * @return DataObject
     * @since 2012-09-09
     */
    public function findOne()
    {
        $dataObjectCollection = $this->limitBy(1)->find();

        return $dataObjectCollection->getFirst();
    }

    /**
     * Adds a filter to narrow down the number of returned data objects.
     * 
     * @author stev leibelt
     * @param int $propertie
     * @param int $criteria
     * @return self
     * @since 2012-09-09
     */
    abstract public function filterBy($propertie, $criteria = self::CRITERIA_EQUAL);

    /**
     * Limits maximum number of entries in returned data object collection.
     * 
     * @author stev leibelt
     * @param int $numberOfEntries
     * @param int $start
     * @return self
     * @since 2012-09-09
     */
    abstract public function limitBy($numberOfEntries, $start = 0);
}
