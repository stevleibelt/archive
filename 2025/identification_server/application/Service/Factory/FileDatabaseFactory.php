<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Service\Factory;

use Database\FileDatabase;
use Service\Locator;

/**
 * Class FileDatabaseFactory
 * @package Service\Factory
 */
class FileDatabaseFactory implements FactoryInterface
{
    /**
     * @param Locator $locator
     * @return \Database\DatabaseInterface
     */
    public function create(Locator $locator)
    {
        $pathToDatabase = realpath(__DIR__ . '/../../../data/dynamic/database.php');
        $data = (is_readable($pathToDatabase)) ? require_once $pathToDatabase : array();
        $hasherFactory = new HasherFactory();
        $identityFactory = new IdentityFactory();

        $database = new FileDatabase($data);
        $database->setLocator($locator);
        $database->setHasher($hasherFactory->create($locator));
        $database->setIdentityFactory($identityFactory);

        return $database;
    }
}