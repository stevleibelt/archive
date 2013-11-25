<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Cache\FileCacheManager;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class FileCacheFactoryService extends ServiceAbstract
{
    /**
     * @author 2013-02-24
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Cache\FileCacheManager
     */
    private static $cacheManagerInstance;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Cache\FileCacheManager
     * @since 2013-02-24
     */
    public function getService()
    {
        if (is_null(self::$cacheManagerInstance)) {
            $fileCacheManager = new FileCacheManager();
            $fileCacheManager->setServiceManager($this->getServiceManager());

            self::$cacheManagerInstance = $fileCacheManager;
        }

        return self::$cacheManagerInstance;
    }
}