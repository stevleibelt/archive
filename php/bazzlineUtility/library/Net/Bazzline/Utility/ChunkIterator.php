<?php

namespace library\Net\Bazzline\Utility;

/**
 * Class represents a ChunktIterator.
 * This Class helps to iterate over a total number of items with a predefined
 *  chunk size [and by setting a limit of maximum number of items to work on).
 * 
 * This class provides static methods as well as a implementation to work with.
 * The naming of the method is based on the php ArrayIterator definition
 *
 * @author stev leibelt
 * @since 2012-09-20
 */
class ChunkIterator
{
    /** @var int */
    private $chunkSize;

    /** @var int */
    private $currentNumberOfChunk;

    /** @var int */
    private $currentChunkSize;

    /** @var array */
    private $itemsToProcess;

    /** @var int */
    private $totalNumberOfItemsWereProcessed;

    /** @var int */
    private $totalNumberOfChunks;

    /** @var int */
    private $totalNumberOfItems;

    /** @var int */
    private $totalNumberOfItemsToProcess;

    /**
     * Calculates the number of chunks.
     * 
     * @author stev leibelt
     * @param int $totalNumberOfItems
     * @param int $chunkSize
     * @return int
     * @since 2012-09-20
     */
    static public function calculateNumberOfChunks($totalNumberOfItems, $chunkSize)
    {
        if (($totalNumberOfItems == 0)
            || ($chunkSize == 0)){
            $numberOfChunks = 0;
        } else if ($totalNumberOfItems > $chunkSize) {
            $numberOfChunks = ceil($totalNumberOfItems / $chunkSize);
        } else {
            $numberOfChunks = 1;
        }

        return (int) $numberOfChunks;
    }

    /**
     * Calculates next chunk size, based input values. Can return the default
     *  chunk size or less depending on provided totalNumberOfItemsToProcess
     * 
     * @author stev leibelt
     * @param int $totalNumberOfItems
     * @param int $totalNumberOfItemsWereProcessed
     * @param int $chunkSize
     * @param int $totalNumberOfItemsToProcess
     * @return int
     * @since 2012-09-20
     */
    static public function calculateNextChunkSize($totalNumberOfItems, $totalNumberOfItemsWereProcessed, $chunkSize, $totalNumberOfItemsToProcess = 0)
    {
        if (((int) $totalNumberOfItemsToProcess < 1)) {
            $totalNumberOfItemsToProcess = $totalNumberOfItems;
        }
        
        if (($totalNumberOfItemsWereProcessed + $chunkSize) > $totalNumberOfItemsToProcess) {
            $nextChunkSize = $totalNumberOfItemsToProcess - $totalNumberOfItemsWereProcessed;
        } else {
            $nextChunkSize = $chunkSize;
        }

        return (int) $nextChunkSize;
    }

    /**
     * Constructor for the class. It sets up the iterator for beeing used.
     * 
     * @author stev leibelt
     * @param int $totalNumberOfItems
     * @param int $chunkSize
     * @param array $options:
     *  - (int) totalNumberOfItemsToProcess (default is 0, $totalNumberOfItems will be the limit)
     *  - (array) itemsToProcess (default is empty array, if is set an array of 
     *     items (with a maximum $chunkSize entries) will be given.
     *     $totalNumnerOfItems will be recalculated it itemsToProcess are set.
     * @since 2012-09-20
     */
    public function __construct($totalNumberOfItems, $chunkSize, array $options = array())
    {
        $defaultOptions = array(
            'totalNumberOfItemsToProcess' => 0,
            'itemsToProcess' => array()
        );
        $options = array_merge($defaultOptions, $options);

        $this->chunkSize = (int) $chunkSize;
        $this->currentNumberOfChunk = 0;
        $this->currentChunkSize = $chunkSize;

        if ((is_array($options['itemsToProcess'])) 
                && (count($options['itemsToProcess']) > 0)) {
            $this->itemsToProcess = $options['itemsToProcess'];
        } else {
            $this->itemsToProcess = array();
            $this->totalNumberOfItems = (int) $totalNumberOfItems;
        }
        $this->totalNumberOfItemsWereProcessed = 0;
        $this->totalNumberOfItemsToProcess = 
            (((int) ($options['totalNumberOfItemsToProcess'])) > 0) 
                ? $this->totalNumberOfItems : (int) $options['totalNumberOfItemsToProcess'];

        $this->totalNumberOfChunks = self::calculateNumberOfChunks(
            $this->totalNumberOfItems, 
            $this->chunkSize
        );
    }

    /**
     * Checks if there are chunks left.
     * 
     * @author stev leibelt
     * @return boolean
     * @since 2012-09-20
     */
    public function isValid()
    {
        $isValid =  (($this->currentNumberOfChunk < $this->totalNumberOfChunks) 
            && ($this->totalNumberOfItemsToProcess > $this->totalNumberOfItemsWereProcessed));

        return $isValid;
    }

    /**
     * Returns next chunk size (chunk size for last chunk can be smaller to fit
     *  with the provided totalNumberOfItemsToProcess).
     * To stay consistence and don't break following code you will always get
     *  back an integer equal or greater 0, even if there is nothing left to 
     *  chunk on.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-20
     */
    public function getNextChunkSize()
    {
        if ($this->isValid()) {
            $nextChunkSize = self::calculateNextChunkSize(
                $this->totalNumberOfItems, 
                $this->totalNumberOfItemsWereProcessed, 
                $this->chunkSize, 
                $this->totalNumberOfItemsToProcess
            );
            $this->currentNumberOfChunk++;
            $this->currentChunkSize = $nextChunkSize;
            $this->totalNumberOfItemsWereProcessed += $nextChunkSize;

            return $this->getCurrentChunkSize();
        } else {
            return 0;
        }
    }

    public function getNextItemsToProcess()
    {
        $nextChunkSize = $this->getNextChunkSize();

        if ($nextChunkSize > 0) {
        } else {
            return array();
        }
    }

    /**
     * Returns current calculated chunk size.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-20
     */
    public function getCurrentChunkSize()
    {
        return $this->currentChunkSize;
    }

    /**
     * Returns current number of chunk.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-21
     */
    public function getCurrentNumberOfChunk()
    {
        return $this->currentNumberOfChunk;
    }

    /**
     * Returns total number of calculated chunks.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-20
     */
    public function getTotalNumberOfChunks()
    {
        return $this->totalNumberOfChunks;
    }

    /**
     * Returns current number of processed items.
     * 
     * @author stev leibelt
     * @return int
     * @since 2012-09-20
     */
    public function getCurrentNumerOfItemsWereProcessed()
    {
        return $this->totalNumberOfItemsWereProcessed;
    }
}
