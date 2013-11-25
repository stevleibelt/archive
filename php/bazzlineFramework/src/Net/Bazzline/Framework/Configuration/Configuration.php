<?php

namespace Net\Bazzline\Framework\Configuration;

use Net\Bazzline\Framework\Utility\ScopeArrayManager;
use Net\Bazzline\Framework\Utility\JsonConvertableInterface;
use Exception;

/**
 * @author stev leibelt
 * @since 2013-02-19
 */
class Configuration extends ScopeArrayManager implements ConfigurationInterface, JsonConvertableInterface
{
    /**
     * @author stev leibelt
     * @param array $configuration
     * @since 2013-02-20
     */
    public function __construct(array $configuration)
    {
        $this->fromArray($configuration);
    }

    /**
     * @author stev leibelt
     * @param string $json
     * @return \Net\Bazzline\Framework\Configuration
     * @since 2013-02-20
     */
    public static function createFromJson($json)
    {
        $className = get_called_class();

        $configuration = new $className(array());
        $configuration->fromJson($json);

        return $configuration;
    }

    /**
     * @author stev leibelt
     * @param string $json
     * @since 2013-02-20
     */
    public function fromJson($json)
    {
        $array = json_decode($json, true);
        $this->fromArray($array);
    }

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-20
     */
    public function toJson()
    {
        $array = $this->toArray();
        $json = json_encode($array);

        return $json;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $value
     * @since 2013-02-20
     */
    public function setParameter($name, $value)
    {
        $message = 'Configuration is not writeable.';

        throw new Exception($message);
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $value
     * @since 2013-02-20
     */
    public function setParameterByPath(array $path, $value)
    {
        $message = 'Configuration is not writeable.';

        throw new Exception($message);
    }
}