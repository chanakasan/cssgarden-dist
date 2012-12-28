<?php
/**
 * Description
 *
 * @author Chanaka
 */
class App_Controller_Plugin_Auth
	extends Zend_Controller_Plugin_Abstract
{        
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();

        //echo "Auth_Plugin".PHP_EOL;
        if (("default" == $moduleName) && ("index" != $controllerName))
        {
            if (Model_Users::isLoggedIn())
            {
                return; // user is logged in
            }            
            elseif (!($request->getControllerName() == 'auth' && $request->getActionName()=='index' && $request->getModuleName() == 'default'))
            {
                $request->setControllerName('auth')
                        ->setActionName('index')
                        ->setModuleName('default');
                return;
            }
            
        }
        if ("admin" == $moduleName)
        {
            if (Model_Users::isLoggedIn() && Model_Users::isAdmin())
            {
                
                return; // user is logged in and has admin privileges
            }
            elseif (!($request->getControllerName() == 'auth' && $request->getActionName()=='index' && $request->getModuleName() == 'admin'))
            {
                $request->setControllerName('auth')
                        ->setActionName('index')
                        ->setModuleName('admin');
                
                return;
            }

        }
        else return;
    }
    
}