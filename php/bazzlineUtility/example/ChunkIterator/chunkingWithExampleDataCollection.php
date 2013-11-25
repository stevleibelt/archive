<?php
/**
 * This example shows you how to use the ChunkIterator with a data collection.
 * A data collection could contain any kind of data and can be used to
 *  reference to the complex data you want to work with.
 *
 * @author stev leibelt
 * @since 2012-09-25
 */
namespace library\Net\Bazzline\Utility\ChunkIterator;

require_once '../../library/Net/Bazzline/Utility/ChunkIterator.php';

$example = new chunkingWithExampleDataCollection();
$example->execute();

/**
 * Class for this example.
 *
 * @author sleibelt
 * @since 2012-09-25
 */
class chunkingWithExampleDataCollection
{
    /**
     * Execute method for example.
     *
     * @author sleibelt
     * @since 2012-09-25
     */
    public function execute()
    {
        $dataCollectionOffset = 0;
        $chunkSize = 10;
        $dataCollection = array();
        $totalNumberOfItems = 33;

        //insert some testdata
        for ($i = 0; $i < $totalNumberOfItems; $i++) {
            $dataCollection[] = 'data ' . $i;
        }

        //schuffel the data
        shuffle($dataCollection);

        //the $dataCollection should demonstrate the fact that you can use the
        // ChunkIterator with a lot of datasets. Since the ChunkIterator does
        // not need to know on what he is working, you can generate an array and
        // work on it with the provided chunkSize.
        $chunkIterator = new \library\Net\Bazzline\Utility\ChunkIterator($totalNumberOfItems, $chunkSize);

        echo '--------' . PHP_EOL;
        echo 'Total number of items: ' . $totalNumberOfItems . PHP_EOL;
        echo 'Chunksize: ' . $chunkSize . PHP_EOL;
        echo '--------' . PHP_EOL;
        echo 'Starting chunking' . PHP_EOL;
        while ($chunkIterator->isValid()) {
            $currentChunkSize = $chunkIterator->getNextChunkSize();

            echo PHP_EOL;
            echo 'Processing chunk number ' .
                $chunkIterator->getCurrentNumberOfChunk() . ' of ' .
                $chunkIterator->getTotalNumberOfChunks() . PHP_EOL;

            //examplecode
            $this->workOnDataCollectionEntries(
                array_slice($dataCollection, $dataCollectionOffset, $chunkSize)
            );
            $dataCollectionOffset += $chunkSize;

            echo 'Current chunk size: ' . $currentChunkSize . PHP_EOL;
            echo 'Totally chunked items: ' .
                $chunkIterator->getCurrentNumerOfItemsWereProcessed() .
                PHP_EOL;
        }
        echo '--------' . PHP_EOL;
    }

    /**
     * Example method do demonstrate how to use the chunkIterator on data
     *  collections
     *
     * @author sleibelt
     * @param array $dataCollection
     * @since 2012-09-25
     */
    public function workOnDataCollectionEntries(array $dataCollection)
    {
        $numberOfEntries = count($dataCollection);

        echo "\t" . 'echoing ' . $numberOfEntries . ' data collection entries' . PHP_EOL;
        echo "\t" . implode(', ', $dataCollection) . PHP_EOL;
    }
}
