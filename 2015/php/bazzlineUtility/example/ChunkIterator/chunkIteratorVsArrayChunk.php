<?php
/**
 * This example shows you how to use the ChunkIterator with a data collection.
 * A data collection could contain any kind of data and can be used to
 *  reference to the complex data you want to work with.
 *
 * @author stev leibelt
 * @since 2012-09-25
 */
namespace library\Net\Bazzline\Utility;

require_once '../../library/Net/Bazzline/Utility/ChunkIterator.php';

$chunkSize = 4000;
$dataCollection = array();
$enableOutput = false;
$totalNumberOfTestData = 65000;

$time = array();

$time['generating']['start'] = microtime(true);
echo '--------' . PHP_EOL;
echo 'Generating testdata.' . PHP_EOL;

for ($i = 0; $i < $totalNumberOfTestData; $i++) {
    $dataCollection[] = new SimpleTestClass();
    if (($i % 10000) === 0) {
        echo PHP_EOL;
    }
    if (($i % 100) === 0) {
        echo '.';
    }
}
shuffle($dataCollection);
$time['generating']['end'] = microtime(true);
$time['generating']['total'] = $time['generating']['end'] - $time['generating']['start'];

echo PHP_EOL;
echo PHP_EOL;
echo 'Generated testdata with ' . $i . ' entries in ' . $time['generating']['total'] . PHP_EOL;
echo '--------' . PHP_EOL;
echo 'Chunking with ChunkIterator' . PHP_EOL;

$chunkIteratorDataCollection = $dataCollection;
$chunkIterator = new ChunkIterator($totalNumberOfTestData, $chunkSize);
$itemsOffset = 0;

$time['chunkIterator']['start'] = microtime(true);
while ($chunkIterator->isValid()) {
    $currentChunkSize = $chunkIterator->getNextChunkSize();
    SimpleOutput::printOutChunk(
        array_slice($chunkIteratorDataCollection, $itemsOffset, $currentChunkSize),
        $enableOutput
    );
}

$time['chunkIterator']['end'] = microtime(true);
$time['chunkIterator']['total'] = $time['chunkIterator']['end'] - $time['chunkIterator']['start'];

echo 'Chunking done with ' . $chunkIterator->getCurrentNumerOfItemsWereProcessed() . ' entries in ' . $time['chunkIterator']['total'] . PHP_EOL;
echo '--------' . PHP_EOL;
echo 'Chunking with array_chunk' . PHP_EOL;

$arrayChunkDataCollection = $dataCollection;

$time['arrayChunk']['start'] = microtime(true);

$chunkedDataCollection = array_chunk($arrayChunkDataCollection, $chunkSize);
foreach ($chunkedDataCollection as $key => $exampleDataCollection) {
    SimpleOutput::printOutChunk($exampleDataCollection, $enableOutput);
}

$time['arrayChunk']['end'] = microtime(true);
$time['arrayChunk']['total'] = $time['arrayChunk']['end'] - $time['arrayChunk']['start'];

echo 'Chunking done with ' . $chunkIterator->getCurrentNumerOfItemsWereProcessed() . ' entries in ' . $time['arrayChunk']['total'] . PHP_EOL;
echo '--------' . PHP_EOL;

/**
 * Class to have on well defined place for output.
 *
 * @author stev leibelt
 * @since 2012-09-26
 */
class SimpleOutput
{
    /**
     * Outputs collection content.
     *
     * @author stev leibelt
     * @param array $collection
     * @since 2012-09-25
     */
    static public function printOutChunk(array $collection, $enableOutput = true)
    {
        if ($enableOutput) {
            echo "\t" . implode(', ', $collection) . PHP_EOL;
        }
    }
}

/**
 * Testfile to get work with objects.
 *
 * @author stev leibelt
 * @since 2012-09-26
 */
class SimpleTestClass
{
    private $foo;
    private $bar;
    private $foobar;
    private $microtime;

    /**
     * Constructor of class
     *
     * @author stev leibelt
     * @since 2012-09-26
     */
    public function __construct()
    {
        $this->foo = 'bar';
        $this->bar = 'foo';
        $this->foobar = 'barfoo';
        $this->microtime = microtime(true);
    }

    /**
     * To string method.
     *
     * @author stev leibelt
     * @return string
     * @since 2012-09-26
     */
    public function __toString()
    {
        return (implode(', ', array($this->foo, $this->bar, $this->foobar)));
    }
}
