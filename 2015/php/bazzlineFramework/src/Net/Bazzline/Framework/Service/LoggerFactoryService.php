<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Logger\Logger;

/**
 * @author stev leibelt
 * @since 2013-03-13
 */
class LoggerFactoryService extends ServiceFactoryAbstract
{
    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @type integer
     */
    const CLASSNAME_WRITER = 0;

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @type integer
     */
    const CLASSNAME_FILTER = 1;

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @type integer
     */
    const FILE_PATH = 2;

    /**
     * @author stev leibelt
     * @since 2013-03-14
     * @type integer
     */
    const MESSAGE_PREFIX = 3;

    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Logger\LoggerInterface
     * @since 2013-03-13
     */
    public static function create(array $data = array())
    {
        $logger = new Logger();

        if (isset($data[self::MESSAGE_PREFIX])) {
            $logger->setMessagePrefix($data[self::MESSAGE_PREFIX]);
        }

        if (isset($data[self::CLASSNAME_WRITER])
            && class_exists($data[self::CLASSNAME_WRITER])) {
            $writer = new $data[self::CLASSNAME_WRITER]();

            if (isset($data[self::FILE_PATH])) {
                $writer->setFilepath($data[self::FILE_PATH]);
            }

            if (isset($data[self::CLASSNAME_FILTER])
                && class_exists($data[self::CLASSNAME_FILTER])) {
                $filter = new $data[self::CLASSNAME_FILTER]();

                $writer->setFilter($filter);
            }
        }

        if (!is_null($writer)) {
            $logger->addWriter($writer);
        }

        return $logger;
    }
}