<?php

namespace Net\Bazzline\Framework\Service;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class StorageFactoryService extends ServiceAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-02-24
     * @var \Net\Bazzline\Framework\Storage\StorageInterface
     */
    private static $storageInstance;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Storage\StorageInterface
     * @since 2013-02-24
     */
    public function getService()
    {
        if (is_null(self::$storageInstance)) {
            $storageClassName = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'class'), '\Net\Bazzline\Storage\DummyStorage');

            self::$storageInstance = new $storageClassName();
            self::$storageInstance->setServiceManager($this->getServiceManager());
        }

        return self::$storageInstance;
    }
}