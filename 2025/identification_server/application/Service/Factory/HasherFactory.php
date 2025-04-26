<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

namespace Service\Factory;

use Model\Hasher;
use Service\Locator;

/**
 * Class HasherFactory
 * @package Service\Factory
 */
class HasherFactory implements FactoryInterface
{
    /**
     * @param Locator $locator
     * @return \Model\Hasher
     */
    public function create(Locator $locator)
    {
        $pathToSalt = realpath(__DIR__ . '/../../../data/dynamic/salt.php');
        $salt = (is_readable($pathToSalt)) ? require_once $pathToSalt : 'demo';

        return new Hasher($salt);
    }
}