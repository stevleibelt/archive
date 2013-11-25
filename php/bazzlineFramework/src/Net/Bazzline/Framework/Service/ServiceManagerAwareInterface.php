<?php

namespace Net\Bazzline\Framework\Service;

/**
 * @author stev leibelt
 * @since 2013-02-18
 */
interface ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @return ServiceManager
     * @since 2013-02-18
     */
    public function getServiceManager();

    /**
     * @author stev leibelt
     * @param ServiceManager $serviceManager
     * @since 2013-02-18
     */
    public function setServiceManager(ServiceManager $serviceManager);
}