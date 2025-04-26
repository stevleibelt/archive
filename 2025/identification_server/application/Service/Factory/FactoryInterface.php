<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Service\Factory;

use Service\Locator;

/**
 * Interface FactoryInterface
 * @package Service\Factory
 */
interface FactoryInterface
{
    /**
     * @param Locator $locator
     * @return mixed
     */
    public function create(Locator $locator);
} 