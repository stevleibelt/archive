<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Configuration\Configuration;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
interface ServiceManagerInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Configuration\Configuration $configuration
     * @since 2013-02-18
     */
    public function __construct(Configuration $configuration);

    /**
     * @author stev leibelt
     * @return \Controller
     * @since 2013-02-18
     */
    public function getController();

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-19
     */
    public function getControllerAction();

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Request\RequestInterface
     * @since 2013-02-18
     */
    public function getRequest();

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Template\ViewInterface
     * @since 2013-02-18
     */
    public function getView();

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Template\LayoutInterface
     * @since 2013-02-18
     */
    public function getLayout();
}