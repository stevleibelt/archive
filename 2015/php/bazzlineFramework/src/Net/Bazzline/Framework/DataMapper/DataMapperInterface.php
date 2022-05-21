<?php

namespace Net\Bazzline\Framework\DataMapper;

use Net\Bazzline\Framework\Model\ModelInterface;

/**
 * @author stev leibelt
 * @since 2013-02-21
 */
interface DataMapperInterface
{
    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Model\ModelInterface $model
     * @return \Net\Bazzline\Framework\Utility\Collection
     * @since 2013-02-21
     * @throws \RuntimeException
     */
    public function find(ModelInterface $model);

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Model\ModelInterface $model
     * @return \Net\Bazzline\Framework\Model\ModelInterface
     * @since 2013-02-21
     * @throws \RuntimeException
     */
    public function findOne(ModelInterface $model);

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Model\ModelInterface $model
     * @return \Net\Bazzline\Framework\Model\ModelInterface
     * @since 2013-02-21
     * @throws \RuntimeException
     */
    public function store(ModelInterface $model);

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Model\ModelInterface $model
     * @return \Net\Bazzline\Framework\Model\ModelInterface
     * @since 2013-02-21
     * @throws \RuntimeException
     */
    public function remove(ModelInterface $model);

    /**
     * @author stev leibelt
     * @param \Net\Bazzline\Framework\Model\ModelInterface $model
     * @return integer
     * @since 2013-02-21
     * @throws \RuntimeException
     */
    public function count(ModelInterface $model);
}