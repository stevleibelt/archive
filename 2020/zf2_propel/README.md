# ZF Module for easy usage of propel 1.x

## code idea

### Module.php

```php
class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $event)
    {
        StaticManager::setServiceLocator($serviceManager);
        $event = $serviceManager->get('SharedEventManager');
        StaticManager::getEventManager()->setSharedManager($event);
    }

    /**
    * @return array
    */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'ZendLoaderClassMapAutoloader' => array(
                    __DIR__ . '/autoload_classmap.php', //includes the propel class maps also
                ),
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
    * @return array
    */
    public function getConfig()
    {
        //since this is pretty stable, we do not need to consume speed by loading and merging a module configuration
        return array(
            'zpropel' => array(
                'runtime-conf' => 'data/zpropel/proxy/build/conf/zpropel-conf.php',
            ),
            'console' => array(
                'router' => array(
                    'routes' => array(
                        'net_bazzline_propel_generate' => array(
                            'options' => array(
                                'route'    => 'net_bazzline propel-generate [convert-conf|insert-sql|sql|om]:script',
                                'defaults' => array(
                                    'controller' => 'NetBazzlineZfPropel\Controller\GenerateController',
                                    'action'     => 'generate'
                                )
                            )
                        ),
                    ),
                ),
            ),
            'controllers' => array(
                'factories' => array(
                '   NetBazzlineZfPropel\Controller\GenerateController' => 'NetBazzlineZfPropel\Controller\GenerateControllerFactory',
                ),
            ),
        );
    }
}
```

```php
<?php
/**
* @author stev leibelt <artodeto@bazzline.net>
* @since 2014-09-02 
*/

//take a look to http://propelorm.org/Propel/documentation/02-buildtime.html#building-the-runtime-configuration
'propel_configuration' => array(
    'adapter'   => 'mysql',
    'connection' => array(
        'classname' => 'PropelPDO',
        'dns'       => 'mysql:host=localhost;port=3306;dbname=example;charset=utf8',
        'password'  => 'password',
        'user'      => 'user_name'
    ),
    'default_database' => 'example'
);

namespace LocatorGenerator\Service;

use Propel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
* Class AbstractLocatorGeneratorFactory
* @package LocatorGenerator\Service
*/
abstract class AbstractLocatorGeneratorFactory implements FactoryInterface
{
    /**
    * Create service
    *
    * @param ServiceLocatorInterface $serviceLocator
    * @return mixed
    */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if (!Propel::isInit()) {
            $configuration = $serviceLocator->get('Config');
            $locatorConfiguration = $configuration['locator_generator'];
            $propelConfiguration = $this->buildPropelConfiguration($locatorConfiguration);

            Propel::init($propelConfiguration);
        }

        return $this->createLocator($serviceLocator);
    }

    /**
    * @param ServiceLocatorInterface $serviceLocator
    * @return mixed
    */
    abstract protected function createLocator(ServiceLocatorInterface $serviceLocator);

    /**
    * @param array $configuration
    * @return array
    */
    private function buildPropelConfiguration(array $configuration)
    {
        $dataSources = array();

        foreach ($configuration['databases'] as $itemName => $itemConfiguration) {
            $dataSources[$itemName] = $itemConfiguration['propel_configuration'];
        }

        $propelConfiguration = array(
            'propel' => array(
                'datasources' => array(
                    $configuration['propel_configuration']
                ),
                'default' => $configuration['default_database']
            )
        );

        return $propelConfiguration;
    }
}
```

# links

* https://github.com/evolic/zf2-propel/tree/master/module/PropelORM
* https://github.com/haizilin/sitework-zf2-refactoring/tree/master/module/Orm/config
* https://github.com/IMHLabs/zf-propel
* https://github.com/MarshallHouse/zpropel
* https://github.com/propelorm/PropelServiceProvider/blob/master/src/Propel/Silex/PropelServiceProvider.php
