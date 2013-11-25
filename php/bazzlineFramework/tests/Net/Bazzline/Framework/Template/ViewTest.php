<?php

namespace Net\Bazzline\Framework\Test\View;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Template\View;
use org\bovigo\vfs\vfsStream;
use Mockery;

/**
* @author stev leibelt
* @since 2013-04-09
*/
class ViewTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-09
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $filesystem;
    /**
     * @author stev leibelt
     * @since 2013-04-09
     * @var string
     */
    private $pathToTemplate;
    /**
     * @author stev leibelt
     * @since 2013-04-09
     * @var string
     */
    private $templateFilename;

    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    protected function setUp()
    {
        $this->pathToTemplate = 'templates';
        $this->templateFilename = 'template.phtml';
        $this->filesystem = vfsStream::setup($this->pathToTemplate);
        $templateFile = vfsStream::newFile($this->templateFilename);
        $templateFile->withContent('hello <?php echo $this->name; ?>')
            ->at($this->filesystem);
        $this->filesystem->addChild($templateFile);
    }

    /**
     * @author stev leibelt
     * @sicne 2013-04-09
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @author stev leibelt
     * @sicne 2013-04-09
     */
    public function testRender()
    {
        $view = $this->createView();
        $view->setValue('name', 'test view value');

        $this->assertEquals('hello test view value', $view->render());
    }

    /**
     * @author stev leibelt
     * @param type $setTemplatePath
     * @return \Net\Bazzline\Framework\Template\View
     * @since 2013-04-09
     */
    private function createView($setTemplatePath = true)
    {
        $view = new View();

        if ($setTemplatePath === true) {
            $templatePath = vfsStream::url(
                $this->pathToTemplate . DIRECTORY_SEPARATOR .
                $this->templateFilename
            );
            $view->setTemplatePath($templatePath);
        }

        return $view;
    }
}