<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
interface FilterAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Logger\FilterInterface $filter
     * @since 2013-03-12
     */
    public function setFilter(FilterInterface $filter);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Logger\FilterInterface
     * @since 2013-03-12
     */
    public function getFilter();
}