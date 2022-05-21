<?php
/**
 * This example shows you how to use the core method "array_chunk" for chunking.
 *
 * @author stev leibelt
 * @since 2012-09-26
 */
namespace library\Net\Bazzline\Utility;

require_once '../../library/Net/Bazzline/Utility/ChunkIterator.php';

$example = new chunkingUsingArrayChunk();
$example->execute();

/**
 * Class for this example.
 *
 * @author sleibelt
 * @since 2012-09-26
 */
class chunkingUsingArrayChunk
{
    /**
     * Execute method for example.
     *
     * @author sleibelt
     * @since 2012-09-26
     */
    public function execute()
    {
        $dataCollectionOffset = 0;
        $chunkSize = 10;
        $exampleDataCollectionollection = array();
        $totalNumberOfItems = 33;

        //insert some testdata
        for ($i = 0; $i < $totalNumberOfItems; $i++) {
            $exampleDataCollection[] = 'data ' . $i;
        }

        //schuffel the data
        shuffle($exampleDataCollection);

        $chunkedDataCollection = array_chunk($exampleDataCollection, $chunkSize);

        echo '--------' . PHP_EOL;
        echo 'Total number of items: ' . $totalNumberOfItems . PHP_EOL;
        echo 'Chunksize: ' . $chunkSize . PHP_EOL;
        echo '--------' . PHP_EOL;
        echo 'Starting chunking' . PHP_EOL;

        foreach ($chunkedDataCollection as $key => $exampleDataCollection) {

            //add your code here

            echo PHP_EOL;
            echo 'Processing chunk number: ' . $key . PHP_EOL;
            echo 'Current chunk size: ' . count($exampleDataCollection) . PHP_EOL;

            $this->workOnExampleDataCollection($exampleDataCollection);
        }
        echo PHP_EOL . '--------' . PHP_EOL;
    }



    /**
     * Just a wrapper that shows how you can work with data.
     *
     * @author stev leibelt
     * @param array $exampleDataCollection
     * @since 2012-09-26
     */
    private function workOnExampleDataCollection(array $exampleDataCollection)
    {
        echo "\t" . implode(', ', $exampleDataCollection);
    }
}
