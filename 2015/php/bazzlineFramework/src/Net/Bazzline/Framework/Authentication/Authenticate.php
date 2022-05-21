<?php

namespace Net\Bazzline\Framework\Authentication;

use Net\Bazzline\Framework\Service\ServiceManagerAwareInterface;
use Net\Bazzline\Framework\Service\ServiceManager;
use Net\Bazzline\Framework\Cookie\Cookie;
use Net\Bazzline\Framework\Cookie\CookieAwareInterface;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
class Authenticate implements AuthenticateInterface, IdentitiyAwareInterface, CredentialAwareInterface, StorageAwareInterface, ServiceManagerAwareInterface, CookieAwareInterface
{
    /**
     * @author stev leibelt
     * @since 2013-03-24
     * @var \Net\Bazzline\Framework\Cookie\Cookie
     */
    private $cookie;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var \Net\Bazzline\Framework\Authentication\CredentialInterface
     */
    private $credential;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var \Net\Bazzline\Framework\Service\ServiceManager
     */
    private $identity;

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @var \Net\Bazzline\Framework\Authentication\StorageInterface
     */
    private $storage;

    /**
     * @author stev leibelt
     * @since 2013-03-17
     * @var \Net\Bazzline\Framework\Service\ServiceManagerInterface
     */
    private $serviceManager;

    /**
     * @author stev leibelt
     * @since 2013-03-18
     * @var array
     */
    private $pathInSession;

    /**
     * @author stev leibelt
     * @since 2013-03-18
     */
    public function __construct()
    {
        $this->pathInSession = array(
            'net' => array(
                'bazzline' => array(
                    'framework' => array(
                        'authenticate'
                    )
                )
            )
        );
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Cookie\Cookie $cookie
     * @since 2013-03-24
     */
    public function setCookie(Cookie $cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Cookie\Cookie
     * @since 2013-03-24
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\CredentialInterface $credential
     * @since 2013-03-16
     */
    public function setCredential(CredentialInterface $credential)
    {
        $this->credential = $credential;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\CredentialInterface $credential
     * @since 2013-03-16
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\IdentitiyInterface $identitiy
     * @since 2013-03-16
     */
    public function setIdentity(IdentitiyInterface $identitiy)
    {
        $this->identity = $identitiy;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\IdentitiyInterface
     * @since 2013-03-16
     */
    public function getIdentity()
    {
        return $this->getServiceManager()
                    ->getSession()
                    ->getParameterByPath($this->pathInSession);
    }

    /**
     * @authors stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\StorageInterface $storage
     * @since 2013-03-16
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\StorageInterface $storage
     * @since 2013-03-16
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Service\ServiceManager $serviceManager
     * @since 2013-03-17
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Service\ServiceManager
     * @since 2013-03-17
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     * @author stev leibelt
     * @since 2013-03-16
     */
    public function clearIdentity()
    {
        $this->getServiceManager()
            ->getSession()
            ->unsetParameterByPath($this->pathInSession);
        $this->storageResult = null;
    }

    /**
     * @author stev leibelt
     * @since 2013-03-16
     */
    public function hasIdentity()
    {
        return (!is_null($this->getIdentitiy()));
    }

    /**
     * @author stev leibelt
     * @since 2013-03-16
     * @throws \Net\Bazzline\Framework\Authentication\AuthenticationException
     */
    public function authenticate()
    {
        if ($this->hasIdentity()) {
            $this->clearIdentity();
        }

        $id = $this->getStorage()
            ->findOne($this->getIdentitiy(), $this->getCredential());
        $this->getServiceManager()
            ->getSession()
            ->setParameterByPath(
                $this->pathInSession,
                $id
            );
    }
}