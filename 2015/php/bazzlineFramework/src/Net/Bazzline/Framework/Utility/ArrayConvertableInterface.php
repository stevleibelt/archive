<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
interface ArrayConvertableInterface
{
    /**
     * @author stev leibelt
     * @param array $array
     * @return ArrayConvertableInterface
     * @since 2013-02-20
     */
    public static function createFromArray(array $array);

    /**
     * @author stev leibelt
     * @param array $array
     * @since 2013-02-20
     */
    public function fromArray(array $array);

    /**
     * @author stev leibelt
     * @return array
     * @since 2013-02-20
     */
    public function toArray();
}
