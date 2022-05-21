<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-02-22
 */
class ArrayManager implements ArrayConvertableInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-22
     * @var array
     */
    private $array;

    /**
     * @author stev leibelt
     * @since 2013-03-27
     */
    public function __construct()
    {
        $this->array = array();
    }

    /**
     * @author stev leibelt
     * @param array $array
     * @return \Net\Bazzline\Framework\Utility\ArrayManager
     * @since 2013-02-22
     */
    public static function createFromArray(array $array)
    {
        $className = get_called_class();

        $arrayManager = new $className($array);
        $arrayManager->fromArray($array);

        return $arrayManager;
    }

    /**
     * @author stev leibelt
     * @param array $array
     * @since 2013-02-22
     */
    public function fromArray(array $array)
    {
        $this->setArray($array);
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-22
     */
    public function toArray()
    {
        return $this->array;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $defaultValue
     */
    public function getParameter($name, $defaultValue = null)
    {
        return (isset($this->array[(string) $name]))
            ? $this->array[(string) $name] : $defaultValue;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @param mixed $value
     * @since 2013-02-22
     */
    public function setParameter($name, $value)
    {
        $this->array[(string) $name] = $value;
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $value
     */
    public function setParameterByPath(array $path, $value)
    {
        $arrayToMerge = $this->createArrayByPath($path, $value);

        $this->setArray(array_replace($arrayToMerge, $this->toArray()));
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $defaultValue
     * @return mixed
     * @since 2013-02-22
     */
    public function getParameterByPath(array $path, $defaultValue = null)
    {
        $array = $this->toArray();

        foreach ($path as $key) {
            if (isset($array[(string) $key])) {
                $array = $array[(string) $key];
            } else {
                $array = $defaultValue;
                break;
            }
        }

        return $array;
    }

    /**
     * @author stev leibelt
     * @param string $name
     * @since 2013-03-17
     */
    public function unsetParameter($name)
    {
        unset($this->array[(string) $name]);
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @since 2013-03-17
     */
    public function unsetParameterByPath(array $path)
    {
        $this->setArray(
            $this->unsetArrayKeyByPath(
                $this->toArray(),
                $path
            )
        );
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @param mixed $value
     * @return array
     */
    protected function createArrayByPath(array $path, $value)
    {
        $currentPathStep = current($path);
        $nextPathStep = next($path);

        return ($nextPathStep !== false)
            ? array($currentPathStep => $this->createArrayByPath($path, $value))
            : array($currentPathStep => $value);
    }

    /**
     * @author stev leibelt
     * @param array $array
     * @since 2013-02-22
     */
    protected function setArray(array $array)
    {
        $this->array = $array;
    }

    /**
     * @author stev leibelt
     * @param array $array
     * @param array $path
     * @since 2013-03-18
     */
    protected function unsetArrayKeyByPath(array &$array, array $path)
    {
        $currentPathStep = current($path);

        if (isset($array[$currentPathStep])) {
            if (is_array($array[$currentPathStep])) {
                next($path);
                $this->unsetArrayKeyByPath($array[$currentPathStep], $path);
            } else {
                unset($array[$currentPathStep]);
            }
        }

        return $array;
    }
}