<?php

namespace Net\Bazzline\Framework\Application;

use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Service\ServiceManager;
use Net\Bazzline\Framework\Configuration\Configuration;

/**
 * @author stev leibelt
 * @since 2013-02-15
 */
class Application implements ApplicationInterface, ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-16
     * @var ServiceManager
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @since 2013-02-15
     */
    private function __construct() {}

    /**
     * @author stev leibelt
     * @param array $configuration
     * @return \Net\Bazzline\Framework\Application\Application
     * @since 2013-02-15
     */
    public static function create(array $configuration = array())
    {
        $application = new self();
        $configuration = Configuration::createFromArray($configuration);
        $serviceManager = new ServiceManager($configuration);
        $application->setServiceManager($serviceManager);

        return $application;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-02-19
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-02-19
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }

    /**
     * @author stev leibelt
     * @since 2013-02-15
     */
    public function andRun()
    {
        $layout = $this->getServiceManager()->getLayout();
        $layout->addView($this->getServiceManager()->getView());

        echo $layout->render();
    }
}