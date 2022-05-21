<?php

namespace Net\Bazzline\Framework\Test\Model;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Model\Model;
use Exception;


/**
* @author stev leibelt
* @since 2013-04-10
*/
class ModelTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testModel()
    {
        $model = new Model();

        $this->assertFalse($model->hasId());
        $model->setId(123);
        try {
            $model->setId(234);
        } catch (Exception $exception) {
            $this->assertEquals('Id already set.', $exception->getMessage());
        }
        $this->assertEquals(123, $model->getId());
        $this->assertTrue($model->hasId());
        $model->resetId();
        $this->assertFalse($model->hasId());
        $model->setId(234);
        $this->assertEquals(234, $model->getId());
    }
}