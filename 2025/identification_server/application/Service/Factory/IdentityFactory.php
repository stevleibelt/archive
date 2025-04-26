<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-20 
 */

namespace Service\Factory;

use Model\Identity;
use Service\Locator;

/**
 * Class IdentityFactory
 * @package Service\Factory
 */
class IdentityFactory implements FactoryInterface
{
    /**
     * @param Locator $locator
     * @return Identity
     */
    public function create(Locator $locator)
    {
        return new Identity();
    }
}