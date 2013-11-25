<?php

namespace Net\Bazzline\Framework\Utility;

/**
 * @author stev leibelt
 * @since 2013-02-20
 */
interface JsonConvertableInterface
{
    /**
     * @author stev leibelt
     * @param string $json
     * @return JsonConvertableInterface
     * @since 2013-02-20
     */
    public static function createFromJson($json);

    /**
     * @author stev leibelt
     * @param string $json
     * @since 2013-02-20
     */
    public function fromJson($json);

    /**
     * @author stev leibelt
     * @return string
     * @since 2013-02-20
     */
    public function toJson();
}
