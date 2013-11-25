<?php

namespace library\Net\Bazzline\Utility;

/**
 * Class represents a MemoryThresholdObserver.
 * This class helps to prevent long running scripts to break since they are 
 *  reaching the memory limit.
 * This class provides a way to shutdown the script in a well defined way.
 * Nevertheless, this class tries to forecast if the next run would stay below
 *  the memory limit. This means, it is still possible to run against the 
 *  memory limit within one loop. If this happens, try to increase the 
 *  threshold.
 * 
 * @author stev leibelt
 * @since 2012-09-28
 */
class MemoryThresholdObserver
{
    const THRESHOLD_LIMIT_MAXIMUM = 100;
    const THRESHOLD_LIMIT_MINIMUM = 0;

    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var int
     */
    private $initialMemoryFootprint;
    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var boolean
     */
    private $isMemoryLimitSet;
    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var int
     */
    private $memoryLimit;
    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var string
     */
    private $threshold;
    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var int
     */
    private $numberOfCalls;
    /**
     * @author stev leibelt
     * @since 2012-09-29
     * @var int
     */
    private $maximumMemoryFootprint;
    /** 
     * @author stev leibelt
     * @since 2012-09-29
     * @var string 
     */
    static private $MEMORY_UNIT_KILOBYTE = 'K';
    /** 
     * @author stev leibelt
     * @since 2012-09-29
     * @var string 
     */
    static private $MEMORY_UNIT_MEGABYTE = 'M';
    /** 
     * @author stev leibelt
     * @since 2012-09-29
     * @var string 
     */
    static private $MEMORY_UNIT_GIGABYTE = 'G';

    /**
     * Initialize the class. Figures out the available memory limit and 
     *  calculates the memory limit maximum by using the given $threshold.
     * 
     * @author stev leibelt
     * @param int $threshold (must be between self::THRESHOLD_LIMIT_MINIMUM and self::THRESHOLD_LIMIT_MAXIMUM)
     * @since 2012-09-29
     */
    public function __construct($threshold = 0)
    {
        $this->initialMemoryFootprint = $this->getCurrentMemoryFootprint();

        $this->threshold = 
            (($threshold >= self::THRESHOLD_LIMIT_MINIMUM) 
                && ($threshold <= self::THRESHOLD_LIMIT_MAXIMUM)) ? $threshold : 0;

        $memoryLimit = ini_get('memory_limit');

        $this->isMemoryLimitSet = 
            (($memoryLimit != '') || ($memoryLimit != -1)) ? true : false;

        if ($this->isMemoryLimitSet) {
            $supportedMemoryUnits = array(
                self::$MEMORY_UNIT_KILOBYTE, 
                self::$MEMORY_UNIT_MEGABYTE, 
                self::$MEMORY_UNIT_GIGABYTE
            );
            $memoryLimitUnit = substr($memoryLimit, -1, 1);

            $memoryLimitUnit = 
                (in_array($memoryLimitUnit, $supportedMemoryUnits)) ? $memoryLimitUnit : '';
            $memoryLimit = (int) $memoryLimit;
            
            switch ($memoryLimitUnit) {
                case self::$MEMORY_UNIT_KILOBYTE:
                    $this->memoryLimit = $memoryLimit * 1024;
                    break;
                case self::$MEMORY_UNIT_MEGABYTE:
                    $this->memoryLimit = $memoryLimit * (pow(1024, 2));
                    break;
                case self::$MEMORY_UNIT_GIGABYTE:
                    $this->memoryLimit = $memoryLimit * (pow(1024, 3));
                    break;
                default:
                    $this->memoryLimit = $memoryLimit;
                    break;
            }
        }

        $this->setLastMemoryFootprint();
        $this->calculateMaximumMemoryFootprint();
    }

    /**
     * Returns true if the memory limit is reachable in the next run.
     * 
     * @author stev leibelt
     * @return boolean
     * @since 2012-09-29
     */
    public function isMemoryLimitReachable()
    {
        if ($this->isMemoryLimitSet) {
            $this->numberOfCalls++;
            $currentMemoryFootprint = $this->getCurrentMemoryFootprint();
            $memoryLimitAfterNextRun = 
                $currentMemoryFootprint + $this->getAverageMemoryAdditionPerLoop();
            $isReachable = ($this->maximumMemoryFootprint > $memoryLimitAfterNextRun);
        } else {
            $isReachable = false;
        }

        return $isReachable;
    }

    /**
     * Returns current memory footprint as integer.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-29
     */
    public function getCurrentMemoryFootprint()
    {
        return memory_get_usage(true);
    }

    /**
     * Returns calculated average memory addition based on numberOfCalls.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-29
     */
    private function getAverageMemoryAdditionPerLoop()
    {
        $average = (($this->getCurrentMemoryFootprint() - $this->initialMemoryFootprint) / $this->numberOfCalls);

        return ceil($average);
    }

    /**
     * Calculates maximumMemoryFootprint by using threshold.
     * 
     * @author stev leibelt
     * @since 2012-09-29
     */
    private function calculateMaximumMemoryFootprint()
    {
        $this->maximumMemoryFootprint = 
            $this->memoryLimit (100 - $this->threshold);
    }
}
