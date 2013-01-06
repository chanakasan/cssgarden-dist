<?php
/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_LayoutPicker
        extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        $moduleName = $request->getModuleName();
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();

        //echo "LayoutPicker".PHP_EOL;
        if('auth' == $controllerName)
            Zend_Layout::getMvcInstance()->setLayout($moduleName.'-'.'login');
        elseif('entry' == $controllerName && 'index' != $actionName)
            Zend_Layout::getMvcInstance()->setLayout('form');
        elseif('user' == $controllerName && 'index' != $actionName)
            Zend_Layout::getMvcInstance()->setLayout('form');
        elseif('cat' == $controllerName && 'index' != $actionName)
            Zend_Layout::getMvcInstance()->setLayout('form');
        elseif('customer' == $controllerName && 'list' != $actionName && 'index' != $actionName)
            Zend_Layout::getMvcInstance()->setLayout('form');
        else
            Zend_Layout::getMvcInstance()->setLayout($moduleName.'-'."template");
    }

}