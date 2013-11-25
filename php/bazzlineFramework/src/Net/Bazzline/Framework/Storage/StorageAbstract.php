<?php

namespace Net\Bazzline\Framework\Storage;

use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Service\ServiceManager;

/**
 * @author stev leibelt
 * @since 2013-03-11
 */
abstract class StorageAbstract implements ServiceManagerAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-11
     * @var array
     */
    protected $errors;

    /**
     * @author stev leibelt
     * @since 2013-03-11
     * @var \Net\Bazzline\Framework\Service\ServiceManager
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-03-11
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-03-11
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-24
     */
    public function hasError()
    {
        return (count($this->errors) > 0);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getError()
    {
        return implode(', ', $this->errors);
    }

    /**
     * @author stev leibelt
     * @since 2013-03-11
     */
    protected function resetErrors()
    {
        $this->errors = array();
    }
}