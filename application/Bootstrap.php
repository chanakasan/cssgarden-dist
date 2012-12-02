<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctype()
    {
        $this->bootstrap('view');        
    }

    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
    }

    protected function _initNavigation()
    {
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $nav_config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml','nav');
        $container = new Zend_Navigation($nav_config);
        $view->navigation($container);
    }
}

