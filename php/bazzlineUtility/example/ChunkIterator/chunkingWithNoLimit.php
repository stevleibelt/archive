<?php
/**
 * This example shows you how to use the ChunkIterator.
 *
 * @author stev leibelt
 * @since 2012-09-25
 */
namespace library\Net\Bazzline\Utility\ChunkIterator;

require_once '../../library/Net/Bazzline/Utility/ChunkIterator.php';

$example = new chunkingWithNoLimit();
$example->execute();

/**
 * Class for this example.
 *
 * @author sleibelt
 * @since 2012-09-25
 */
class chunkingWithNoLimit
{
    /**
     * Execute method for example.
     *
     * @author sleibelt
     * @since 2012-09-25
     */
    public function execute()
    {
        $totalNumberOfItems = 17380;
        $chunkSize = 1337;

        $chunkIterator = new \library\Net\Bazzline\Utility\ChunkIterator($totalNumberOfItems, $chunkSize);

        echo '--------' . PHP_EOL;
        echo 'Total number of items: ' . $totalNumberOfItems . PHP_EOL;
        echo 'Chunksize: ' . $chunkSize . PHP_EOL;
        echo '--------' . PHP_EOL;
        echo 'Starting chunking' . PHP_EOL;
        while ($chunkIterator->isValid()) {
            $currentChunkSize = $chunkIterator->getNextChunkSize();

            //add your code here

            echo PHP_EOL;
            echo 'Processing chunk number ' .
                $chunkIterator->getCurrentNumberOfChunk() . ' of ' .
                $chunkIterator->getTotalNumberOfChunks() . PHP_EOL;
            echo 'Current chunk size: ' . $currentChunkSize . PHP_EOL;
            echo 'Totally chunked items: ' .
                $chunkIterator->getCurrentNumerOfItemsWereProcessed() .
                PHP_EOL;
        }
        echo '--------' . PHP_EOL;
    }
}
