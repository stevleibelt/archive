<?php

namespace Net\Bazzline\Framework\Storage;

use Net\Bazzline\Framework\Utility\Collection;
use PDO;
use PDOException;

/**
 * @author stev leibelt
 * @since 2013-03-11
 */
abstract class PDOStorageAbstract extends StorageAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-11
     * @var \PDO
     */
    private $pdo;

    /**
     * @author stev leibelt
     * @since 2013-03-11
     */
    abstract protected function getNewPdo();

    /**
     * @author stev leibelt
     * @return \PDO
     * @since 2013-03-11
     */
    protected function getPdo()
    {
        if (is_null($this->pdo)) {
            $this->pdo = $this->getNewPdo();
        }

        return $this->pdo;
    }

    /**
     * @author stev leibelt
     * @param string $statement
     * @return \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-02-24
     */
    public function fetchAll($statement)
    {
        $collection = new Collection();

        try {
            $this->getPdo()->beginTransaction();
            $pdoStatement = $this->getPdo()->query($statement);
            $result = $pdoStatement->fetchAll(PDO::FETCH_OBJ);
            foreach ($result as $rowObject) {
                $collection->push($rowObject);
            }
            $this->getPdo()->commit();
        } catch (PDOException $exception) {
            $this->getPdo()->rollBack();

            $this->errors[] = $this->getPdo()->errorCode();
            $this->errors[] = $this->getPdo()->errorInfo();
            $this->errors[] = $exception->getMessage();
            $this->errors[] = $exception->getFile();
            $this->errors[] = $exception->getLine();
            $this->errors[] = $exception->getTrace();
        }

        return $collection;
    }

    /**
     * @author stev leibelt
     * @param string $statement
     * @return number of touched entries
     * @since 2013-02-24
     */
    public function execute($statement)
    {
        $result = null;

        try {
            $this->getPdo()->beginTransaction();
            $this->getPdo()->exec($statement);
            $result = $this->getPdo()->lastInsertId();
            $this->getPdo()->commit();
        } catch (PDOException $exception) {
            $this->getPdo()->rollBack();

            $this->errors[] = $this->getPdo()->errorCode();
            $this->errors[] = $this->getPdo()->errorInfo();
            $this->errors[] = $exception->getMessage();
            $this->errors[] = $exception->getFile();
            $this->errors[] = $exception->getLine();
            $this->errors[] = $exception->getTrace();
        }

        return $result;
    }
}