<?php

namespace Net\Bazzline\Framework\Test\Template;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Template\Layout;
use org\bovigo\vfs\vfsStream;
use Mockery;

/**
* @author stev leibelt
* @since 2013-04-04
*/
class LayoutTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-06
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $filesystem;

    /**
     * @author stev leibelt
     * @since 2013-04-06
     * @var string
     */
    private $pathToTemplate;

    /**
     * @author stev leibelt
     * @since 2013-04-06
     * @var string
     */
    private $templateFilename;

    /**
     * @author stev leibelt
     * @since 2013-04-06
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
     * @since 2013-04-06
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @author stev leibelt
     * @since 2013-04-06
     */
    public function testDisableLayoutWithoutViews()
    {
        $layout = $this->createLayout(false);
        $layout->disableLayout();

        $this->assertEquals('', $layout->render());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-06
     */
    public function testDisableLayoutWithViews()
    {
        $layout = $this->createLayout(false);
        $layout->disableLayout();

        $viewOne = $this->createViewMock('viewOne');
        $viewTwo = $this->createViewMock('viewTwo');
        $layout->addView($viewOne);
        $layout->addView($viewTwo);

        $this->assertEquals('viewOneviewTwo', $layout->render());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-06
     */
    public function testRender()
    {
        $layout = $this->createLayout();
        $layout->setValue('name', 'test value');

        $this->assertEquals('hello test value', $layout->render());
    }

    /**
     * @author stev leibelt
     * @since 2013-04-09
     */
    public function testRenderWithView()
    {
        $layout = $this->createLayout();
        $layout->disableLayout();
        $viewMock = Mockery::mock('Net\Bazzline\Framework\Template\View');
        $viewMock->shouldReceive('render')
            ->andReturn('view test render')
            ->once();
        $layout->addView($viewMock);

        $this->assertEquals('view test render', $layout->render());
    }

    /**
     * @author stev leibelt
     * @param string $returnValueOfRenderMethod
     * @return \Net\Bazzline\Framework\Template\View
     * @since 2013-04-06
     */
    private function createViewMock($returnValueOfRenderMethod = '')
    {
        $viewMock = Mockery::mock('Net\Bazzline\Framework\Template\View');
        $viewMock->shouldReceive('render')->andReturn($returnValueOfRenderMethod);

        return $viewMock;
    }

    /**
     * @author stev leibelt
     * @param boolean $setTemplatePath
     * @return \Net\Bazzline\Framework\Template\Layout
     * @since 2013-04-06
     */
    private function createLayout($setTemplatePath = true)
    {
        $layout = new Layout();
        if ($setTemplatePath === true) {
            $templatePath = vfsStream::url(
                $this->pathToTemplate . DIRECTORY_SEPARATOR .
                $this->templateFilename
            );
            $layout->setTemplatePath($templatePath);
        }

        return $layout;
    }
}