<?php


/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_Auth
	extends Zend_Controller_Plugin_Abstract
{        
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        $session = new Zend_Session_Namespace('default');

        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        
        if (('default' == $moduleName) && ('index' != $controllerName))
        {
            if (Model_Users::isLoggedIn())            
                return; // user is logged in and allowed to access admin functions
            
            if ('auth' != $controllerName)
            {
                $request->setModuleName('default')
                        ->setControllerName('auth')
                        ->setDispatched(FALSE);
            }
        }
        elseif (('admin' == $moduleName) && ('auth' != $controllerName))
        {
            $request->setModuleName('admin')
                    ->setControllerName('auth')
                    ->setDispatched(FALSE);
        }
        else return;
    }
    
}