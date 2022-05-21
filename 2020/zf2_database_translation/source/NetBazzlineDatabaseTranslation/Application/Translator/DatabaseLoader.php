<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-07-26
 */
namespace NetBazzlineDatabaseTranslation\Application\Translator;

use Zend\I18n\Translator\Loader\RemoteLoaderInterface;

class DatabaseLoader implements RemoteLoaderInterface
{
    /**
     * Load translations from a remote source.
     *
     * @param  string $locale
     * @param  string $textDomain
     * @return \Zend\I18n\Translator\TextDomain|null
     */
    public function load($locale, $textDomain)
    {
        // TODO: Implement load() method.
    }
}