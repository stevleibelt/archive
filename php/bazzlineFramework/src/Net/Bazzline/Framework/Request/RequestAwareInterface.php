<?php

namespace Net\Bazzline\Framework\Request;

/**
 * @author stev leibelt
 * @since 2013-02-15
 */
interface RequestAwareInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\RequestInterface $request
     * @since 2013-02-15
     */
    public function setRequest(RequestInterface $request);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\RequestInterface
     * @since 2013-02-16
     */
    public function getRequest();
}