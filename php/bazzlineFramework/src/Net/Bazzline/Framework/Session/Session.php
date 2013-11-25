<?php

namespace Net\Bazzline\Framework\Session;

use Net\Bazzline\Framework\Utility\ScopeArrayManager;
use Net\Bazzline\Framework\Utility\JsonConvertableInterface;
use Net\Bazzline\Framework\Configuration\ConfigurationInterface;

/**
 * @author stev leibelt
 * @since 2013-02-21
 */
class Session extends ScopeArrayManager implements ConfigurationInterface, JsonConvertableInterface
{
    /**
     * @author stev leibelt
     * @param array $
     * @since 2013-02-22
     */
    public function __construct(array $session = array())
    {
        $this->initialize();
        if (isset($_SESSION)) {
            $this->fromArray(array_merge($_SESSION, $session));
        } else {
            $this->fromArray($session);
        }
    }

    /**
     * @author stev leibelt
     * @since 2013-04-10
     */
    public function __destruct()
    {
        $this->stop();
    }

    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function start()
    {
        session_start();
    }

    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function clean()
    {
        $this->initialize();
        session_unset();
    }

    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    public function stop()
    {
        session_write_close();
    }

    /**
     * @author stev leibelt
     * @param string $json
     * @return \Net\Bazzline\Framework\Session
     * @since 2013-02-22
     */
    public static function createFromJson($json)
    {
        $className = get_called_class();

        $session = new $className(array());
        $session->fromJson($json);

        return $session;
    }

    /**
     * @author stev leibelt
     * @param string $json
     * @since 2013-02-22
     */
    public function fromJson($json)
    {
        $array = json_decode($json, true);
        $this->fromArray($array);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-22
     */
    public function toJson()
    {
        $array = $this->toArray();
        $json = json_encode($array);

        return $json;
    }


    /**
     * @author stev leibelt
     * @since 2013-02-22
     */
    protected function initialize()
    {
        $this->setOriginalArray(array());
        $this->resetScope();
        if (PHP_MINOR_VERSION >= 4) {
            if (session_status() !== PHP_SESSION_ACTIVE
                && !headers_sent()) {
                $this->start();
            }
        } else {
            if (session_id() == ''
                && !headers_sent()) {
                $this->start();
            }
        }
    }
}