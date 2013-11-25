<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Utility\FactoryInterface;
use Net\Bazzline\Framework\Service\ServiceManager;
use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
abstract class ServiceFactoryAbstract implements FactoryInterface, ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Service\ServiceManager
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-02-24
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-02-24
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
}