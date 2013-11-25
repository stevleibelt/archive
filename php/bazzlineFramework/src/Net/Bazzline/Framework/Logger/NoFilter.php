<?php

namespace Net\Bazzline\Framework\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-12
 */
class NoFilter implements FilterInterface
{
    /**
     * @author stev leibelt
     * @param integer $loglevel
     * @return boolean
     * @since 2013-03-13
     */
    public function accept($loglevel)
    {
        return true;
    }
}