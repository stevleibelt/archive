<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-07-26
 */
namespace NetBazzlineDatabaseTranslation\Application\Translator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DatabaseLoaderFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $loader = new DatabaseLoader();

        return $loader;
    }
}