<?php

namespace Net\Bazzline\Framework\Storage;

use PDO;
use PDOException;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class MySQLStorage extends PDOStorageAbstract
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
        $username = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'username'), null);
        $password = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'password'), null);
        $options = $this->getServiceManager()
                ->getConfiguration()
                ->getParameterByPath(array('storage', 'database', 'options'), null);


        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $exception) {
            $this->errors[] = $exception->getMessage();
            $this->errors[] = $exception->getFile();
            $this->errors[] = $exception->getLine();
            $this->errors[] = $exception->getTrace();
        }

        return $pdo;
    }
}