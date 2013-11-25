<?php

namespace library\Net\Bazzline\Utility;

require_once '../../../../../library/Net/Bazzline/Utility/ChunkIterator.php';

/**
 * Test for ChunkIterator
 *
 * @author stev leibelt
 * @category Testing
 * @package Bazzline_Util
 * @since 2012-09-20
 */
class ChunkIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for chunk iterator itself as class.
     *
     * @author stev leibelt
     * @since 2012-09-20
     */
    public function testChunkIterator()
    {
        //numberOfResults, chunkSize, limit, expectedNumberOfChunks
        $tests = array(
            array(0, 500, null, 0),
            array(499, 500, null, 1),
            array(999, 500, null, 2),
            array(1001, 500, null, 3)
        );

        foreach ($tests as $test) {
            $chunkIterator = new ChunkIterator($test[0], $test[1], $test[2]);

            $this->assertTrue($chunkIterator->isValid());
            $numberOfChunks = 0;
            $expectedNumberOfChunks = $test[3];

            while ($chunkIterator->isValid()) {
                $nextChunkSize = $chunkIterator->getNextChunkSize();
                $numberOfChunks++;

                $this->assertLessThanOrEqual($test[1], $nextChunkSize);
            }

            $this->assertEquals($expectedNumberOfChunks, $numberOfChunks);
        }
    }
}
