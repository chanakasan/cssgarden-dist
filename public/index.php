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

/* Configure Routes */

/* Default Module */
$userlogin = new Zend_Controller_Router_Route(
    'login',
    array(
        'controller' => 'auth',
        'action' => 'index',
        'module' => 'default'
    )
);

$front = Zend_Controller_Front::getInstance();
$front->getRouter()->addRoute('user-login', $userlogin);

/* Admin Module */
$adminlogin = new Zend_Controller_Router_Route(
    'admin/login',
    array(
        'controller' => 'auth',
        'action' => 'index',
        'module' => 'admin'
    )
);
$customers = new Zend_Controller_Router_Route(
    'admin/c/:cat/:action/:id',
    array(
        'controller' => 'customer',        
        'module' => 'admin',
        'cat' => 0,
        'id' => 0
    )
);
$adminreports1 = new Zend_Controller_Router_Route(
    'admin/report/u/:id',
    array(
        'controller' => 'report',
        'action' => 'u',
        'module' => 'admin',        
    )
);
$adminreports2 = new Zend_Controller_Router_Route(
    'admin/report/dwp/:dwp_no',
    array(
        'controller' => 'report',
        'action' => 'dwp',
        'module' => 'admin',        
    )
);
$front->getRouter()->addRoute('admin-login', $adminlogin);
$front->getRouter()->addRoute('customers', $customers);
$front->getRouter()->addRoute('admin-reports', $adminreports1);
$front->getRouter()->addRoute('admin-reports2', $adminreports2);


unset($front);

$application->bootstrap()
            ->run();