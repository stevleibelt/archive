<?php

namespace Net\Bazzline\Framework\Storage;

use PDO;
use PDOException;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class SQLiteStorage extends PDOStorageAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-11
     */
    protected function getNewPdo()
    {
        $this->resetErrors();
        $dsn = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'dsn'), null);

        try {
            $pdo = new PDO($dsn);
        } catch (PDOException $exception) {
            $this->errors[] = $exception->getMessage();
            $this->errors[] = $exception->getFile();
            $this->errors[] = $exception->getLine();
            $this->errors[] = $exception->getTrace();
        }

        return $pdo;
    }
}