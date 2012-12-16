<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$userlogin = new Zend_Controller_Router_Route(
    'login',
    array(
        'controller' => 'auth',
        'action' => 'index',
        'module' => 'default'
    )
);
$adminlogin = new Zend_Controller_Router_Route(
    'admin/login',
    array(
        'controller' => 'auth',
        'action' => 'index',
        'module' => 'admin'
    )
);
$front = Zend_Controller_Front::getInstance();
$front->getRouter()->addRoute('userlogin', $userlogin);
$front->getRouter()->addRoute('adminlogin', $adminlogin);

unset($front);

$application->bootstrap()
            ->run();