<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
interface ScopeLimitableInterface
{
    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-03-30
     */
    public function hasScope();

    /**
     * @author stev leibelt
     * @return mixed string | null
     * @since 2013-02-20
     */
    public function getScope();

    /**
     * @author stev leibelt
     * @since 2013-02-20
     */
    public function resetScope();

    /**
     * @author stev leibelt
     * @param string $scope
     * @since 2013-02-20
     * @throws InvalidArgumentException
     */
    public function setScope($scope);

    /**
     * @author stev leibelt
     * @param array $path
     * @since 2013-02-20
     * @throws InvalidArgumentException
     */
    public function setScopeByPath(array $path);
}