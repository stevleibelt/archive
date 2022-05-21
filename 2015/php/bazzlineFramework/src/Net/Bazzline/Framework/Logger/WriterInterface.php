<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface WriterInterface extends FilterAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\FilterInterface $filter
     * @since 2013-03-14
     */
    public function setFilter(FilterInterface $filter);

    /**
     * @author stev leibelt
     * @param string $filepath
     * @since 2013-03-13
     */
    public function setFilepath($filepath);

    /**
     * @author stev leibelt
     * @param string $message
     * @param integer $loglevel
     * @since 2013-03-13
     */
    public function addMessage($message, $loglevel);

    /**
     * @author stev leibelt
     * @since 2013-03-13
     */
    public function append();

    /**
     * @author stev leibelt
     * @since 2013-03-13
     */
    public function write();

    /**
     * @author stev leibelt
     * @since 2013-03-13
     */
    public function overwrite();

    /**
     * @author stev leibelt
     * @param boolean
     * @since 2013-03-13
     */
    public function exists();
}