<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Service\ServiceManager;
use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Utility\FactoryInterface;

/**
 * @author stev leibelt
 * @since 2013-02-21
 */
abstract class ServiceAbstract implements ServiceInterface, ServiceManagerAwareInterface, FactoryInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Service\ServiceAbstract;
     */
    private static $instanceByClassName;

    /**
     * @author stev leibelt
     * @since 2013-02-23
     * @var \Net\Bazzline\Framework\Service\ServiceManager
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Service\ServiceAbstract
     * @since 2013-02-24
     */
    public static function create(array $data = array())
    {
        $className = get_called_class();
        if (is_null(self::$instanceByClassName)) {
            self::$instanceByClassName = array();
        }

        if (!isset(self::$instanceByClassName[$className])) {
            $service = new $className();

            self::$instanceByClassName[$className] = $service;
        }

        return self::$instanceByClassName[$className];
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-02-23
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-02-23
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-24
     */
    private function __construct() {}
}