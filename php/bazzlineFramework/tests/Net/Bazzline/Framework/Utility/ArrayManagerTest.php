<?php

namespace Net\Bazzline\Framework\Test\Utility;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Utility\ArrayManager;

/**
* @author stev leibelt
* @since 2013-03-27
*/
class ArrayManagerTest extends PHPUnit_Framework_TestCase
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
        $this->array = array(
            'key1' => 'value1',
            1 => 2,
            'value',
            'key2' => array(
                'key2-1' => 'value2-1'
            )
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testToArray()
    {
        $arrayManager = $this->getNewArrayManager();

        $this->assertEquals($this->array, $arrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testCreateFromArray()
    {
        $arrayManager = ArrayManager::createFromArray($this->array);

        $this->assertEquals($this->array, $arrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testFromArray()
    {
        $arrayManager = $this->getNewArrayManager(false);
        $arrayManager->fromArray($this->array);

        $this->assertEquals($this->array, $arrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testGetParameter()
    {
        $arrayManager = $this->getNewArrayManager();

        foreach ($this->array as $key => $value) {
            $this->assertEquals($value, $arrayManager->getParameter($key));
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testSetParameter()
    {
        $arrayManager = $this->getNewArrayManager(false);

        foreach ($this->array as $key => $value) {
            $arrayManager->setParameter($key, $value);
        }

        $this->assertEquals($this->array, $arrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testUnsetParameter()
    {
        $arrayManager = $this->getNewArrayManager();

        foreach ($this->array as $key => $value) {
            $arrayManager->unsetParameter($key);
            unset($this->array[$key]);
            $this->assertEquals($this->array, $arrayManager->toArray());
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testSetParameterByPath()
    {
        $arrayManager = $this->getNewArrayManager(false);
        $path = array('key1', 'key1-1', 'key1-1-1');
        $value = 'value1-1-1';
        $expectedArray = array(
            'key1' => array(
                'key1-1' => array(
                    'key1-1-1' => 'value1-1-1'
                )
            )
        );

        $arrayManager->setParameterByPath($path, $value);

        $this->assertEquals($expectedArray, $arrayManager->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testGetParameterByPath()
    {
        $arrayManager = $this->getNewArrayManager();
        $path = array('key2', 'key2-1');

        $this->assertEquals(
            $this->array['key2']['key2-1'],
            $arrayManager->getParameterByPath($path)
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function testUnsetParameterByPath()
    {
        $arrayManager = $this->getNewArrayManager();
        $path = array('key2', 'key2-1');
        $arrayManager->unsetParameterByPath($path);

        $this->assertNull(
            $arrayManager->getParameterByPath($path)
        );
    }

    /**
     * @author stev leibelt
     * @param boolean $isFilled
     * @return \Net\Bazzline\Framework\Utility\ArrayManager
     * @since 2013-03-27
     */
    private function getNewArrayManager($isFilled = true)
    {
        return ($isFilled) ?
            ArrayManager::createFromArray($this->array) : new ArrayManager();
    }
}