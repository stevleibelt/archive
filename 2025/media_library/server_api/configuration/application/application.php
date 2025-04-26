<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-18 
 */

$baseDir = dirname(__FILE__);

return array(
    'debug' => true,
    'registration.enabled' => false,
    'cache.http' => $baseDir . '/../../cache/http',
    'propel.configuration' => $baseDir . '/../propel/media-library-conf.php',
    'propel.models' => $baseDir . '/../../source//MediaLibrary/Model/Database/'
);
