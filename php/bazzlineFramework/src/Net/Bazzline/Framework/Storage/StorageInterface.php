<?php

namespace Net\Bazzline\Framework\Storage;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
interface StorageInterface
{
    /**
     * @author stev leibelt
     * @param string $statement
     * @return \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-02-24
     */
    public function fetchAll($statement);

    /**
     * @author stev leibelt
     * @param string $statement
     * @return mixed
     * @since 2013-02-24
     */
    public function execute($statement);

    /**
     * @author stev leibelt
     * @return boolean
     * @since 2013-02-24
     */
    public function hasError();

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-24
     */
    public function getError();
}