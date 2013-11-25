<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Http\Request;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class HttpRequestFactoryService extends ServiceFactoryAbstract
{
    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Http\Request
     * @since 2013-02-24
     */
    public static function create(array $data = array())
    {
        $request = new Request();

        return $request;
    }
}