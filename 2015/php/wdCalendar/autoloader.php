<?php
/**
 * @todo Add classmap to speed up autoloading
 * @todo http://getcomposer.org/doc/01-basic-usage.md#autoloading
 * @author stev leibelt
 * @param string $className
 * @since 2013-02-15
 */
function autoloadFromFilesystem($className)
{
    $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    $includePaths = array(
        'application'
    );

    foreach ($includePaths as $includePath) {
        $filePath = $includePath . DIRECTORY_SEPARATOR . $fileName;

        if (file_exists($filePath)) {
            require_once $filePath;

            break;
        }
    }
}

spl_autoload_register('autoloadFromFilesystem');

require 'vendor/autoload.php';