<?php

namespace Net\Bazzline\Framework\Test\Storage;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Storage\DummyStorage;

/**
* @author stev leibelt
* @since 2013-04-09
*/
class DummyStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    public function testFetchAll()
    {
        $dummyStorage = $this->getDummyStorage();
        $statement = '';

        $this->assertInstanceOf(
            'Net\Bazzline\Framework\Utility\Collection',
            $dummyStorage->fetchAll($statement)
        );
        $this->assertTrue(($dummyStorage->fetchAll($statement)->count() > 0));
    }

    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    public function testExecute()
    {
        $dummyStorage = $this->getDummyStorage();
        $statement = '';

        $this->assertNull($dummyStorage->execute($statement));
    }

    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    public function testHasError()
    {
        $dummyStorage = $this->getDummyStorage();

        $this->assertFalse($dummyStorage->hasError());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    public function testGetError()
    {
        $dummyStorage = $this->getDummyStorage();

        $this->assertEquals('', $dummyStorage->getError());
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Storage\DummyStorage
     * @since 2013-04-09
     */
    private function getDummyStorage()
    {
        $dummyStorage = new DummyStorage();

        return $dummyStorage;
    }
}