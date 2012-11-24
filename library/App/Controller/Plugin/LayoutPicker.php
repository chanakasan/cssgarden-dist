<?php
/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_LayoutPicker
	extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();

        if ('default' == $moduleName)
        {
            if('auth' == $controllerName)
                Zend_Layout::getMvcInstance()->setLayout('login');
            else if('test' == $controllerName)
                Zend_Layout::getMvcInstance()->setLayout('test');
            else if('error' == $controllerName)
                Zend_Layout::getMvcInstance()->setLayout('error');
            else
                Zend_Layout::getMvcInstance()->setLayout($request->getModuleName());

        }
        else {
            if('auth' == $controllerName)
                Zend_Layout::getMvcInstance()->setLayout($moduleName.'-'.'login');
            else
                Zend_Layout::getMvcInstance()->setLayout($request->getModuleName());
        }

    }
    
}


