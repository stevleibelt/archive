<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface LoggerInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\WriterInterface $writer
     * @since 2013-03-14
     */
    public function addWriter(WriterInterface $writer);

    /**
     * @author stev leibelt
     * @param string $messagePrefix
     * @since 2013-03-13
     */
    public function setMessagePrefix($messagePrefix);

    /**
     * @author stev leibelt
     * @param string $message
     * @since 2013-03-12
     */
    public function debug($message);

    /**
     * @author stev leibelt
     * @param string $message
     * @since 2013-03-12
     */
    public function info($message);

    /**
     * @author stev leibelt
     * @param string $message
     * @since 2013-03-12
     */
    public function error($message);

    /**
     * @author stev leibelt
     * @param string $message
     * @since 2013-03-12
     */
    public function warn($message);

    /**
     * @author stev leibelt
     * @param string $message
     * @since 2013-03-12
     */
    public function fatal($message);
}