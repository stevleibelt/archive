<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface LoggerAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\LoggerInterface $logger
     * @since 2013-03-12
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Logger\LoggerInterface
     * @since 2013-03-12
     */
    public function getLogger();
}