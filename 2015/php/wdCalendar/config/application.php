<?php

return array(
    'storage' => array(
        'database' => array(
            'tablePrefix' => '',
            'class' => '\Net\Bazzline\Framework\Storage\SQLiteStorage',
            'dsn' => 'sqlite:data/database/event',
            'username' => '',
            'password' => '',
            'options' => array()
        )
    ),
    'cache' => array(
        'path' => 'data/cache'
    ),
    'default' => array(
        'controller' => '\Controller\Calendar',
        'action' => 'authenticateAction'
    ),
    'template' => array(
        'layout' => array(
            'path' => 'application/Layout',
            'file' => 'Calendar.phtml'
        ),
        'view' => array(
            'path' => 'application/View'
        )
    )
);
