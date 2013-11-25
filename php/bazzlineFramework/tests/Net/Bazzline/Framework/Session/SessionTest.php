<?php

namespace Net\Bazzline\Framework\Test\Session;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Session\Session;

/**
* @author stev leibelt
* @since 2013-04-09
*/
class SessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-10
     * @var array
     */
    private $expectedSessionArray;

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    protected function setUp()
    {
        $this->expectedSessionArray = array(
            'key1' => 'value1',
            'key2' => array(
                'key2-1' => 'value2-1'
            )
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testConstruct()
    {
        $emptySession = new Session();
        $this->assertEquals(array(), $emptySession->toArray());
        unset($emptySession);

        $sessionByArray = new Session($this->expectedSessionArray);
        $this->assertEquals($this->expectedSessionArray, $sessionByArray->toArray());
        unset($sessionByArray);

        $_SESSION = array('key3' => 'value3');
        $session = new Session($this->expectedSessionArray);
        $this->assertEquals(
            array_merge($_SESSION, $this->expectedSessionArray),
            $session->toArray()
        );
        unset($_SESSION, $session);
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testCreateFromJson()
    {
        $json = json_encode($this->expectedSessionArray);
        $session = Session::createFromJson($json);

        $this->assertEquals($this->expectedSessionArray, $session->toArray());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testFromJson()
    {
        $json = json_encode($this->expectedSessionArray);
        $session = new Session();
        $session->fromJson($json);

        $this->assertEquals($this->expectedSessionArray, $session->toArray());
    }
}