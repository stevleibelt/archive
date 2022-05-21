<?php
//make everything relative to the application root
chdir(dirname(__DIR__));

require_once 'autoloader.php';

\Net\Bazzline\Framework\Application\Application::create(require_once 'config/application.php')
    ->andRun();