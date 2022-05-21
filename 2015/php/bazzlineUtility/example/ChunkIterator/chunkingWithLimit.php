<?php
/**
 * This example shows you how to use the ChunkIterator with a limit.
 * There a possible scenarios out there where you know that your process can
 *  work on $limit number of items in x minutes (think about cronjobs).
 *
 * @author stev leibelt
 * @since 2012-09-25
 */
namespace library\Net\Bazzline\Utility\ChunkIterator;

require_once '../../library/Net/Bazzline/Utility/ChunkIterator.php';

$example = new chunkingWithLimit();
$example->execute();

/**
 * Class for this example.
 *
 * @author sleibelt
 * @since 2012-09-25
 */
class chunkingWithLimit
{
    /**
     * Execute method for example.
     *
     * @author sleibelt
     * @since 2012-09-25
     */
    public function execute()
    {
        $totalNumberOfItems = 42130815;
        $chunkSize = 1337;
        $limit = 1711;

        $chunkIterator = new \library\Net\Bazzline\Utility\ChunkIterator($totalNumberOfItems, $chunkSize, $limit);

        echo '--------' . PHP_EOL;
        echo 'Total number of items: ' . $totalNumberOfItems . PHP_EOL;
        echo 'Chunksize: ' . $chunkSize . PHP_EOL;
        echo 'Limit: ' . $limit . PHP_EOL;
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
