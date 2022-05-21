<?php

namespace Net\Bazzline\Framework\Service;

use Net\Bazzline\Framework\Template\View;

/**
 * @author stev leibelt
 * @since 2013-02-24
 */
class ViewFactoryService extends ServiceFactoryAbstract
{
    /**
     * @author stev leibelt
     * @param array $data
     * @return \Net\Bazzline\Framework\Template\View
     * @since 2013-02-24
     */
    public static function create(array $data = array())
    {
        $view = new View($data);

        return $view;
    }
}