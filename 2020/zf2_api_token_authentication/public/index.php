<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2015-09-03
 */

use Zend\Expressive\AppFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$application = AppFactory::create();

$application->get('/', function ($request, $response, $next) {
    /** @var \Zend\Stratigility\Http\Request $request */
    /** @var \Zend\Stratigility\Http\Response $response */
    //$response->write(var_export($request->getHeaders(), true));
    //@see: https://zend-expressive.readthedocs.org/en/latest/application/
    $response->write('Hello, world!');
    return $response;
});

$application->run();