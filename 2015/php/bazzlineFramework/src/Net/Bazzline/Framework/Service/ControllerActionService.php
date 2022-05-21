<?php

namespace Net\Bazzline\Framework\Service;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class ControllerActionService extends ServiceAbstract
{
    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getService()
    {
        $actionName = lcFirst($this->getServiceManager()
            ->getRequest()
            ->getParameter('action', 'index')) . 'Action';
        $controllerAction = (in_array($actionName, get_class_methods(get_class($this->getServiceManager()->getController()))))
            ? $actionName : $this->getDefaultAction();

        return $controllerAction;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-17
     */
    private function getDefaultAction()
    {
        $controller = $this->getServiceManager()
            ->getController();
        $defaultControllerClass = $this->getServiceManager()
            ->getConfiguration()
            ->getParameterByPath(array('default', 'controller'));
        $defaultControllerAction = $this->getServiceManager()
            ->getConfiguration()
            ->getParameterByPath(array('default', 'action'));
        $defaultAction = 'index';

        return (string) ($controller instanceof $defaultControllerClass)
            ? $defaultControllerAction : $defaultAction;
    }
}