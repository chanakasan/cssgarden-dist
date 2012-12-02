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

        if ($request->getModuleName() != 'admin')
	    return;            

	if ($session->authenticated === true) {
            //user is logged in and allowed to access admin functions
            return;
        }

        if ($request->getControllerName() != 'auth')
        {
            $request->setModuleName('admin')
                    ->setControllerName('auth')
                    ->setDispatched(FALSE);
        }
        else return;
    }
    
}