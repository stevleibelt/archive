<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Template\Layout;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class LayoutFactoryService extends ServiceFactoryAbstract
{
    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Template\Layout
     * @since 2013-02-24
     */
    public static function create(array $data = array())
    {
        $layout = new Layout();

        return $layout;
    }
}