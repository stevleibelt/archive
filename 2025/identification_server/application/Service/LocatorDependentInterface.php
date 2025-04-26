<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-23 
 */

namespace Service;

/**
 * Interface LocatorDependentInterface
 * @package Service
 */
interface LocatorDependentInterface
{
    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator);
} 