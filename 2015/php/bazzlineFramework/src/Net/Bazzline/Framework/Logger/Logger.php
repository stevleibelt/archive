<?php

namespace Net\Bazzline\Framework\Logger;

use Net\Bazzline\Framework\Utility\Collection;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
class Logger implements LoggerInterface, WriterAwareInterface
{
    const LEVEL_DEBUG = 0;
    const LEVEL_INFO = 1;
    const LEVEL_WARN = 2;
    const LEVEL_ERROR = 3;
    const LEVEL_FATAL = 4;

    /**
     * @author stev leibelt
     * @since 2013-03-13
     * @var string
     */
    private $messagePrefix;

    /**
     * @author stev leibelt
     * @since 2013-03-13
     * @var \Net\Bazzline\Framework\Utility\Collection
     */
    private $writers;

    /**
     * @author stev leibelt
     * @since 2013-03-13
     */
    public function __construct()
    {
        $this->writers = new Collection();
        $this->setMessagePrefix('');
    }

    /**
     * @author stev leibelt
     * @param string $messagePrefix
     * @since 2013-03-13
     */
    public function setMessagePrefix($messagePrefix)
    {
        $this->messagePrefix = (string) $messagePrefix;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\WriterInterface $writer
     * @since 2013-03-13
     */
    public function addWriter(WriterInterface $writer)
    {
        $this->writers->push($writer);
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-03-13
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * @authors stev leibelt
     * @param string $message
     * @since 2013-03-14
     */
    public function debug($message)
    {
        $this->push($message, self::LEVEL_DEBUG);
    }

    /**
     * @authors stev leibelt
     * @param string $message
     * @since 2013-03-14
     */
    public function info($message)
    {
        $this->push($message, self::LEVEL_INFO);
    }

    /**
     * @authors stev leibelt
     * @param string $message
     * @since 2013-03-14
     */
    public function error($message)
    {
        $this->push($message, self::LEVEL_ERROR);
    }

    /**
     * @authors stev leibelt
     * @param string $message
     * @since 2013-03-14
     */
    public function warn($message)
    {
        $this->push($message, self::LEVEL_WARN);
    }

    /**
     * @authors stev leibelt
     * @param string $message
     * @since 2013-03-14
     */
    public function fatal($message)
    {
        $this->push($message, self::LEVEL_FATAL);
    }

    /**
     * @author stev leibelt
     * @param string $message
     * @param integer $loglevel
     * @since 2013-03-14
     */
    private function push($message, $loglevel)
    {
        foreach ($this->getWriters() as $writer) {
            $writer->add($this->messagePrefix . $message, $loglevel);
            $writer->append();
        }
    }
}