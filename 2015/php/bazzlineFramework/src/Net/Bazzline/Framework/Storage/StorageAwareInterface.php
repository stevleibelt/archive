<?php

namespace Net\Bazzline\Framework\Storage;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface StorageAwareInterface
{
    /**
     * @authors stev leibelt
     * @param \Net\Bazzline\Framework\Storage\StorageInterface $storage
     * @since 2013-03-16
     */
    public function setStorage(StorageInterface $storage);

    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Storage\StorageInterface
     * @since 2013-03-16
     */
    public function getStorage();
}