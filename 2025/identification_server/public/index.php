<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-02-22 
 */
require_once '../vendor/autoload.php';

use Luracast\Restler\Restler;

$server = new Restler();

$server->addAPIClass('Controller\IndexController', '/');
$server->addAPIClass('Controller\IdentifyController', '/identify');
$server->addAPIClass('Controller\IdentityController', '/identity');
//$server->addAPIClass('Controller\ServiceController', '/service');
//$server->addAPIClass('Controller\UserController', '/user');

$server->handle();
