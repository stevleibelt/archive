<?php

namespace Net\Bazzline\Framework\Cache;

use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Service\ServiceManager;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
abstract class CacheManagerAbstract implements CacheManagerInterface, ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Service\ServiceManagerInterface
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-02-24
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-02-24
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
}