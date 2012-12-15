<?php

class App_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract
{
    public function loggedInAs ()
    {        
        $request = Zend_Controller_Front::getInstance()->getRequest();        
        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $username = $auth->getIdentity()->username;
            if('default' == $module)
            {
                return '<p>Welcome! ' . '<span class="strong">'.$username.',</span>'.' <a href="/auth/logout">Logout</a></p>';
            }
            else
                return '<p>Welcome! ' . '<span class="strong">'.$username.',</span>'.' <a href="/admin/auth/logout">Logout</a></p>';
            //$logoutUrl = $this->view->url(array('module'=> $module, 'controller'=>'auth', 'action'=>'logout'));
            //return '<p class="last">Welcome! ' . '<span class="strong">'.$username.',</span>'.' <a href="'.$logoutUrl.'">Logout</a></p>';
            
        }       
        
        if($controller == 'auth' && $action == 'index') {
            return;
        }
        //$loginUrl = $this->view->url(array('module'=> $module,'controller'=>'auth', 'action'=>'index'));
        //return '<a href="'.$loginUrl.'">Login</a>';
        return '<a href="/login">Login</a>';
    }
}