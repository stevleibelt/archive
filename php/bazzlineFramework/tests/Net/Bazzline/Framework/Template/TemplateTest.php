<?php

namespace Net\Bazzline\Framework\Test\Template;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Template\Template;

/**
* @author stev leibelt
* @since 2013-04-04
*/
class TemplateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-04
     * @var \Net\Bazzline\Framework\Template\Template
     */
    private $template;

    /**
     * @author stev leibelt
     * @since 2013-04-04
     * @var string
     */
    private $templatePath;

    /**
     * @author stev leibelt
     * @since 2013-04-04
     */
    protected function setUp()
    {
        $this->template = new Template();
        $this->templatePath = '/tmp/' . __CLASS__ . date('Y-m-d') . '.phtml';
        touch($this->templatePath);
    }

    /**
     * @author stev leibelt
     * @since 2013-04-04
     */
    protected function tearDown()
    {
        unlink($this->templatePath);
    }

    /**
     * @author stev leibelt
     * @since 2013-04-04
     */
    public function testSetAndGetValue()
    {
        $testValue = array('key' => 'value');

        $this->assertNull($this->template->getValue('test'));
        $this->template->setValue('test', $testValue);
        $this->assertEquals($testValue, $this->template->getValue('test'));
        $this->assertEquals($testValue, $this->template->test);
    }

    /**
     * @author stev leibelt
     * @since 2013-04-04
     */
    public function testSetAndGetTemplatePath()
    {
        $this->assertEquals('', $this->template->getTemplatePath());
        $this->template->setTemplatePath($this->templatePath);
        $this->assertEquals($this->templatePath, $this->template->getTemplatePath());
    }
}