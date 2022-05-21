<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-02-23
 */
interface FactoryInterface
{
    /**
     * @author stev leibelt
     * @param array $data
     * @return mixed
     * @since 2013-02-23
     * @throws \InvalidArgumentException
     */
    public static function create(array $data = array());
}
