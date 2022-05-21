<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
abstract class WriterAbstract implements WriterInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @var string
     */
    private $filepath;

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @var \Net\Bazzline\Framework\Logger\FilterInterface
     */
    private $filter;

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @var array
     */
    private $messagesPerLoglevel;

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\FilterInterface $filter
     * @since 2013-03-14
     */
    public function setFilter(FilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Logger\FilterInterface
     * @since 2013-03-14
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @author stev leibelt
     * @param string $message
     * @param string $loglevel
     * @since 2013-03-14
     */
    public function addMessage($message, $loglevel)
    {
        $this->messagesPerLoglevel[$loglevel][] = $message;
    }

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @return array
     */
    protected function getMessagesPerLoglevel()
    {
        return $this->messagesPerLoglevel;
    }

    /**
     * @author stev leibelt
     * @since 2013-03-14
     */
    protected function resetMessagesPerLoglevel()
    {
        $this->messagesPerLoglevel = array();
    }

    /**
     * @author stev leibelt
     * @param string $filepath
     * @since 2013-03-14
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-03-14
     */
    protected function getFilepath()
    {
        return $this->filepath;
    }
}