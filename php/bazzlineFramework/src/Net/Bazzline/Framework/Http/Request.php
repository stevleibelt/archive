<?php

namespace Net\Bazzline\Framework\Http;

use Net\Bazzline\Framework\Request\RequestInterface;

/**
 * @author stev leibelt
 * @since 2013-02-16
 */
class Request implements RequestInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-17
     * @type integer
     */
    const REQUEST_CONTROLLER_ACTION = 0;
    /**
     * @author stev leibelt
     * @since 2013-02-17
     * @type integer
     */
    const REQUEST_MODULE_CONTROLLER_ACTION = 1;

    /**
     * @author stev leibelt
     * @since 2013-02-15
     * @var array
     */
    private $parameters;



    /**
     * @author stev leibelt
     * @since 2013-02-15
     * @todo add escaping and security
     * @var string
     */
    private $uri;

    public function __construct($mode = self::REQUEST_CONTROLLER_ACTION)
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $parsedUrlPath = parse_url($this->uri, PHP_URL_PATH);
        $explodedUrlPath = explode('/', substr($parsedUrlPath, 1));
        $parameters = array();

        //Http/PhpEnvironment/Request.php
        //Zend/Stdlib/Parameters.php
        if ($mode === self::REQUEST_MODULE_CONTROLLER_ACTION) {
            if (array_key_exists(0, $explodedUrlPath)) {
                $parameters['module'] = array_shift($explodedUrlPath);
            }
        }
        if (array_key_exists(0, $explodedUrlPath)) {
            $parameters['controller'] = array_shift($explodedUrlPath);
        }
        if (array_key_exists(0, $explodedUrlPath)) {
            $parameters['action'] = array_shift($explodedUrlPath);
        }

        while ($explodedUrlPath) {
            if (array_key_exists(0, $explodedUrlPath)) {
                if(array_key_exists(1, $explodedUrlPath)) {
                    $parameters[array_shift($explodedUrlPath)] = array_shift($explodedUrlPath);
                } else {
                    array_shift($explodedUrlPath);
                }
            }
        }

        $parameters = array_merge($parameters, $this->getGetParameters(), $this->getPostParameters());

        $this->parameters = (count($parameters) > 0) ? $parameters : array();
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-15
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-15
     */
    public function getParameter($name, $default = null)
    {
        return $this->getArrayParameter($this->getParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    public function getEnvParemeter($name, $default = null)
    {
        return $this->getArrayParameter($this->getEnvParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    public function getCookieParameter($name, $default = null)
    {
        return $this->getArrayParameter($this->getCookieParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    public function getPostParameter($name, $default = null)
    {
        return $this->getArrayParameter($this->getPostParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    public function getGetParameter($name, $default = null)
    {
        return $this->getArrayParameter($this->getGetParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    public function getServerParameter($name, $default = null)
    {
        return $this->getArrayParameter($this->getServerParameters(), $name, $default);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-18
     */
    public function getMethod()
    {
        return $this->getServerParameter('REQUEST_METHOD');
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-18
     */
    public function isPost()
    {
        return ($this->getMethod() == 'POST');
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-18
     */
    public function isGet()
    {
        return ($this->getMethod() == 'GET');
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-18
     */
    public function isAjax()
    {
        return ($this->getServerParameter('HTTP_X_REQUESTED_WITH') == 'XMLHttpRequest');
    }

    /**
     * @todo http://php.net/manual/de/reserved.variables.files.php
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    public function getFiles()
    {
        return $_FILES;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    protected function getPostParameters()
    {
        return $_POST;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    protected function getGetParameters()
    {
        return $_GET;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    protected function getCookieParameters()
    {
        return $_COOKIE;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    protected function getEnvParameters()
    {
        return $_ENV;
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-18
     */
    protected function getServerParameters()
    {
        return $_SERVER;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @since 2013-02-18
     */
    protected function getArrayParameter(array $array, $name, $default = null)
    {
        return (array_key_exists($name, $array)) ? $array[(string) $name] : $default;
    }
}
