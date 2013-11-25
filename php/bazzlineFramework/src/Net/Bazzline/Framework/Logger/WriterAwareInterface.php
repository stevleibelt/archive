<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface WriterAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\WriterInterface $writer
     * @since 2013-03-12
     */
    public function addWriter(WriterInterface $writer);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-03-12
     */
    public function getWriters();
}