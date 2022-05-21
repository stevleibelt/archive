<?php

namespace Net\Bazzline\Framework\Test\Utility;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Utility\ScopeArrayManager;

/**
* @author stev leibelt
* @since 2013-03-27
*/
class ScopeArrayManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-03-28
     * @var array
     */
    private $array;

    /**
     * @author stev leibelt
     * @since 2013-03-28
     */
    protected function setUp()
    {
        $this->array = array(
            'key1' => array(
                'key1-1' => 'value1-1'
            ),
            1 => 'value1',
            'scope' => array(
                'subscope' => 'scopvalue'
            )
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-03-28
     */
    public function testFromArray()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray($this->array);

        $this->assertEquals($this->array, $scopeArrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-30
     */
    public function testToArray()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray(array());

        $this->assertEquals(array(), $scopeArrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-30
     */
    public function testSetAndGetScope()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray($this->array);

        $this->assertEquals(null, $scopeArrayManager->getScope());
        $scopeArrayManager->setScope('key1');
        $this->assertEquals('key1', $scopeArrayManager->getScope());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-30
     */
    public function testResetScope()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray($this->array);

        $scopeArrayManager->setScope('key1');
        $this->assertEquals('key1', $scopeArrayManager->getScope());
        $scopeArrayManager->resetScope();
        $this->assertEquals(null, $scopeArrayManager->getScope());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-30
     */
    public function testHasScope()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray($this->array);

        $this->assertEquals(false, $scopeArrayManager->hasScope());
        $scopeArrayManager->setScope('key1');
        $this->assertEquals(true, $scopeArrayManager->hasScope());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-04
     */
    public function testSetScopeByPath()
    {
        $scopeArrayManager = new ScopeArrayManager();
        $scopeArrayManager->fromArray($this->array);

        $scopeArrayManager->setScopeByPath(array('key1', 'key1-1'));
        $this->assertEquals('key1-1', $scopeArrayManager->getScope());
        $this->assertEquals($this->array['key1'], $scopeArrayManager->toArray());
    }
}