<?php

namespace Net\Bazzline\Framework\Test\Utility;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Utility\Collection;

/**
* @author stev leibelt
* @since 2013-03-27
*/
class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-03-27
     * @var array
     */
    private $array;

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    protected function setUp()
    {
        $this->array = array();
        for ($iterator = 0; $iterator < 10; $iterator++) {
            $this->array[$iterator] = 'value' . $iterator;
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testRewind()
    {
        $collection = $this->getNewCollection();
        $iteraterToThis = count($this->array) - 3;
        $iterator = 0;

        foreach ($collection as $value) {
            $this->assertTrue(in_array($value, $this->array));
            if (++$iterator > $iteraterToThis) {
                break;
            }
        }

        $collection->rewind();

        $this->assertEquals($this->array[0], $collection->current());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testCurrent()
    {
        $collection = $this->getNewCollection();

        $this->assertEquals($this->array[0], $collection->current());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testKey()
    {
        $collection = $this->getNewCollection();

        $this->assertEquals(0, $collection->key());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testNext()
    {
        $collecion = $this->getNewCollection();

        foreach ($this->array as $key => $value) {
            $this->assertEquals($key, $collecion->key());
            $collecion->next();
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testValid()
    {
        $collecion = $this->getNewCollection();

        foreach ($this->array as $key => $value) {
            $this->assertTrue($collecion->valid());
            $collecion->next();
        }

        $this->assertFalse($collecion->valid());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testPush()
    {
        $collection = $this->getNewCollection();
        $numberOfEntriesBeforePush = $collection->count();
        $collection->push(null);
        $numberOfEntriesAfterPushingNull = $collection->count();
        $collection->push('foo');
        $numberOfEntriesAfterPushingString = $collection->count();

        $this->assertEquals(
            $numberOfEntriesBeforePush,
            $numberOfEntriesAfterPushingNull
        );
        $this->assertEquals(
            ($numberOfEntriesBeforePush + 1),
            $numberOfEntriesAfterPushingString
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testPop()
    {
        $collection = $this->getNewCollection();

        foreach ($this->array as $key => $value) {
            $poppedValue = $collection->pop();
            if (!is_null($poppedValue)) {
                $this->assertTrue(in_array($poppedValue, $this->array));
            }
        }

        $this->assertEquals(0, $collection->count());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testShift()
    {
        $collection = $this->getNewCollection();

        foreach ($this->array as $key => $value) {
            $shiftedValue = $collection->shift();
            if (!is_null($shiftedValue)) {
                $this->assertEquals($value, $shiftedValue);
            }
        }

        $this->assertEquals(0, $collection->count());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testCount()
    {
        $this->assertEquals(0, $this->getNewCollection(false)->count());
        $this->assertEquals(count($this->array), $this->getNewCollection()->count());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    private function getNewCollection($isFilled = true)
    {
        $collection = new Collection();

        if ($isFilled) {
            foreach ($this->array as $value) {
                $collection->push($value);
            }
        }

        return $collection;
    }
}