<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = new Zend_Controller_Request_Simple($action, $controller);
        $response = new Zend_Controller_Response_Http();
        $frontController = Zend_Controller_Front::getInstance();
        $dispatcher = $frontController->getDispatcher();
        $dispatcher->dispatch($request, $response);
        echo $response->getBody();
    }


}

