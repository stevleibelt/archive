<?php

namespace Net\Bazzline\Framework\Controller;

use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Service\ServiceManager;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
abstract class ControllerAbstract implements ControllerInterface, ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-18
     * @var \Net\Bazzline\Framework\Service\ServiceManagerInterface
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-19
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-02-18
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-02-18
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}