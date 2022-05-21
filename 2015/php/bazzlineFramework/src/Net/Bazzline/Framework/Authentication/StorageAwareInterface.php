<?php

namespace Net\Bazzline\Framework\Authentication;

/**
 * @author stev leibelt
 * @since 2013-03-16
 */
interface StorageAwareInterface
{
    /**
     * @author stev leibelt
     * @return \Net\Bazzline\Framework\Authentication\StorageInterface
     * @since 2013-03-18
     */
    public function getStorage();

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Authentication\StorageInterface $storage
     * @since 2013-03-18
     */
    public function setStorage(StorageInterface $storage);
}