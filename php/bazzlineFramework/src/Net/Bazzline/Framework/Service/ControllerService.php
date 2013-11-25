<?php

namespace Net\Bazzline\Framework\Service;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class ControllerService extends ServiceAbstract
{
    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Controller\ControllerInterface
     * @since 2013-02-24
     */
    public function getService()
    {
        $controllerName = ucfirst($this->getServiceManager()
            ->getRequest()
            ->getParameter('controller'));
        $controllerClass = '\Controller\\' . $controllerName;

        $controller = (class_exists($controllerClass))
            ? new $controllerClass : $this->getDefaultController();
        $controller->setServiceManager($this->getServiceManager());

        return $controller;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Controller\ControllerInterface
     * @since 2013-02-17
     */
    private function getDefaultController()
    {
        $controllerClass = $this->getServiceManager()
            ->getConfiguration()
            ->getParameterByPath(array('default', 'controller'));

        return new $controllerClass();
    }
}