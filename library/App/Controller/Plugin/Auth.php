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
        
        if (('default' == $moduleName) && ('index' != $controllerName))
        {
            if (Model_Users::isLoggedIn())            
                return; // user is logged in
            
            if ('auth' != $controllerName)
            {
                $request->setModuleName('default')
                        ->setControllerName('auth')
                        ->setDispatched(FALSE);
            }
        }
        elseif ('admin' == $moduleName)
        {           
            if (Model_Users::isLoggedIn() && Model_Users::isAdmin())
                return; // user is logged in and allowed to access admin functions

             if ('auth' != $controllerName)
             {
                $request->setModuleName('admin')
                        ->setControllerName('auth')
                        ->setDispatched(FALSE);
             }
        }
        else return;
    }
    
}