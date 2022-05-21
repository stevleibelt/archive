<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Configuration\ConfigurationAwareInterface;
use Net\Bazzline\Framework\Configuration\Configuration;

/**
 * @author stev leibelt
 * @since 2013-02-18
 */
class ServiceManager implements ServiceManagerInterface, ConfigurationAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var \Net\Bazzline\Framework\Configuration\ConfigurationInterface
     */
    private $configuration;

    /**
     * @author stev leibelt
     * @since 2013-02-18
     * @var \Net\Bazzline\Framework\Controller\ControllerInterface
     */
    private $controller;

    /**
     * @author stev leibelt
     * @since 2013-02-18
     * @var string
     */
    private $controllerAction;

    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Cache\CacheManagerInterface
     */
    private $cacheManager;

    /**
     * @author stev leibelt
     * @since 2013-02-23
     * @var \Net\Bazzline\Framework\Template\LayoutInterface
     */
    private $layout;

    /**
     * @author stev leibelt
     * @since 2013-02-18
     * @var \Net\Bazzline\Framework\Request\RequestInterface
     */
    private $request;

    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\StorageInterface
     */
    private $storage;

    /**
     * @author stev leibelt
     * @since 2013-03-17
     * @var \Net\Bazzline\Framework\Session\SessionInterface
     */
    private $session;

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Configuration\Configuration $configuration
     * @since 2013-02-18
     */
    public function __construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);
        $this->layout = LayoutFactoryService::create();
        $this->request = HttpRequestFactoryService::create();

        ControllerService::create()->setServiceManager($this);
        ControllerActionService::create()->setServiceManager($this);
        FileCacheFactoryService::create()->setServiceManager($this);
        StorageFactoryService::create()->setServiceManager($this);
        SessionFactoryService::create()->setServiceManager($this);

        $this->controller = ControllerService::create()->getService();
        $this->controllerAction = ControllerActionService::create()->getService();
        $this->cacheManager = FileCacheFactoryService::create()->getService();
        $this->storage = StorageFactoryService::create()->getService();
        $this->session = SessionFactoryService::create()->getService();
    }
    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Configuration\Configuration $configuration
     * @since 2013-02-20
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Configuration\Configuration $configuration
     * @since 2013-02-18
     */
    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Controller\ControllerInterface
     * @since 2013-02-18
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-19
     */
    public function getControllerAction()
    {
        return (string) $this->controllerAction;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Request\RequestInterface
     * @since 2013-02-18
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Template\ViewInterface
     * @since 2013-02-18
     */
    public function getView()
    {
        $action = $this->getControllerAction();
        $data = $this->getController()->$action();

        if (!($data instanceof View)) {
            $view = ViewFactoryService::create($data);
            $templatePath = $this->getConfiguration()->getParameterByPath(array('template', 'view', 'path')) .
                DIRECTORY_SEPARATOR .
                substr(ucfirst(get_class($this->getController())), 11) . '/' .      //removing "Controller\\"
                substr(ucfirst($this->getControllerAction()), 0, -6) . '.phtml';    //removing "Action"

            $view->setTemplatePath($templatePath);
        } else {
            $view = $data;
        }

        return $view;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Template\LayoutInterface
     * @since 2013-02-18
     */
    public function getLayout()
    {
        $this->getRequest()->getParameter('controller');

        $this->getConfiguration()->setScopeByPath(array('template', 'layout'));
        $templatePath = $this->getConfiguration()->getParameter('path') .
            DIRECTORY_SEPARATOR . $this->getConfiguration()->getParameter('file');
        $this->getConfiguration()->resetScope();

        $this->layout->setTemplatePath($templatePath);

        return $this->layout;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Cache\CacheManagerInterface
     * @since 2013-02-24
     */
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Storage\StorageInterface
     * @since 2013-02-24
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Session\SessionInterface
     * @since 2013-03-17
     */
    public function getSession()
    {
        return $this->session;
    }
}