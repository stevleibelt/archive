<?php

namespace Net\Bazzline\Framework\Utility;

use InvalidArgumentException;

/**
 * @author stev leibelt
 * @since 2013-02-23
 */
class ScopeArrayManager extends ArrayManager implements ScopeLimitableInterface
{
    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var string
     */
    private $scope;

    /**
     * @author stev leibelt
     * @since 2013-02-20
     * @var array
     */
    private $originalArray;

    /**
     * @author stev leibelt
     * @param array $array
     * @since 2013-02-22
     */
    public function fromArray(array $array)
    {
        parent::fromArray($array);
        $this->setOriginalArray($array);
        $this->resetScope();
    }

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-23
     */
    public function toArray()
    {
        return (is_null(parent::toArray())) ?
            $this->getOriginalArray() : parent::toArray();
    }

    /**
     * @author stev leibelt
     * @return mixed string | null
     * @since 2013-02-23
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-03-30
     */
    public function hasScope()
    {
        return (!is_null($this->scope));
    }

    /**
     * @author stev leibelt
     * @since 2013-02-23
     */
    public function resetScope()
    {
        $this->scope = null;
        $this->setArray($this->getOriginalArray());
    }

    /**
     * @author stev leibelt
     * @param string $scope
     * @since 2013-02-23
     * @throws InvalidArgumentException
     */
    public function setScope($scope)
    {
        if (array_key_exists((string) $scope, $this->toArray())) {
            $this->scope = (string) $scope;
        } else {
            $message = 'Scope "' . $scope . '" does not exist.';

            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @author stev leibelt
     * @param array $path
     * @since 2013-02-23
     * @throws InvalidArgumentException
     */
    public function setScopeByPath(array $path)
    {
        $this->resetScope();
        $scopedArray = $this->getOriginalArray();

        foreach ($path as $key) {
            $scope = $key;
            if (isset($scopedArray[$key])) {
                if (!is_array($scopedArray[(string) $key])) {
                    $scopedArray = array(
                        (string) $key => $scopedArray[(string) $key]
                    );
                } else {
                    $scopedArray = $scopedArray[(string) $key];
                }
            } else {
                $scopedArray = array();
                break 2;
            }
        }

        if ((is_array($scopedArray))
            && (count($scopedArray) > 0)) {
            $this->setArray($scopedArray);
            $this->setScope($scope);
        } else {
            $message = 'Scopepath "' . implode('.', $path) . '" does not exist.';

            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @autor stev leibelt
     * @param array $originalArray
     * @since 2013-02-23
     */
    protected function setOriginalArray(array $originalArray)
    {
        $this->originalArray = $originalArray;
    }

    /**
     * @autor stev leibelt
     * @return array
     * @since 2013-02-23
     */
    protected function getOriginalArray()
    {
        return $this->originalArray;
    }
}