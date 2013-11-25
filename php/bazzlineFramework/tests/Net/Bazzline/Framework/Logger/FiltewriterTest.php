<?php

namespace Net\Bazzline\Framework\Test\Logger;

use PHPUnit_Framework_TestCase;
use Net\Bazzline\Framework\Logger\Filewriter;
use Net\Bazzline\Framework\Logger\Logger;
use org\bovigo\vfs\vfsStream;
use Mockery;


/**
* @author stev leibelt
* @since 2013-04-10
*/
class FilewriterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt
     * @since 2013-04-10
     * @var \org\bovigo\vfs\vfsStreamFile
     */
    private $file;

    /**
     * @author stev leibelt
     * @since 2013-04-10
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    private $filesystem;

    /**
     * @author stev leibelt
     * @since 2013-04-10
     * @var string
     */
    private $filename;

    /**
     * @author stev leibelt
     * @since 2013-04-10
     * @var string
     */
    private $filepath;

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    protected function setUp()
    {
        $this->filename = 'filewriter.log';
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testAppend()
    {
        $fileContent = 'first entry';
        $filewriter = $this->getNewFileWriter($fileContent);
        $filewriter->addMessage('second entry', Logger::LEVEL_DEBUG);
        $filewriter->append();

        $this->assertEquals(
            'first entry' . PHP_EOL . 'second entry',
            $this->file->getContent()
        );
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function testWrite()
    {
        $fileContent = 'first entry';
        $filewriter = $this->getNewFileWriter($fileContent);
        $filewriter->addMessage('second entry', Logger::LEVEL_DEBUG);
        $filewriter->write();

        $this->assertEquals(
            'second entry',
            $this->file->getContent()
        );
    }

    /**
     * @author stev leibelt
     * @param string $fileContent
     * @return \Net\Bazzline\Framework\Logger\Filewriter
     * @since 2013-04-10
     */
    private function getNewFileWriter($fileContent = '')
    {
        $this->filesystem = vfsStream::setup('root');
        $this->file = vfsStream::newFile($this->filename);
        $this->file->withContent($fileContent)
            ->at($this->filesystem);
        $this->filesystem->addChild($this->file);
        $this->filepath = vfsStream::url(
            'root' . DIRECTORY_SEPARATOR . $this->filename
        );
        $filterMock = Mockery::mock('Net\Bazzline\Framework\Logger\NoFilter');
        $filterMock->shouldReceive('accept')
            ->andReturn(true);

        $filewriter = new Filewriter();
        $filewriter->setFilepath($this->filepath);
        $filewriter->setFilter($filterMock);

        return $filewriter;
    }
}