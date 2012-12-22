<?php

/**
 * Description of AsyncController
 *
 * @author Chanaka
 */
class AsyncController extends Zend_Controller_Action
{

   /*
    * @var Zend_Session_Namespace
    */
    private $_session;

    public function init()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
    }

    public function preDisptch()
    {
        //$this->_session = new Zend_Session_Namespace('default');

        if(!$this->_session->view)
                $this->_session->view = $this->view;

    }

    public function loadcityAction()
    {
        if($this->getRequest()->isPost())
        {
            echo "load city";
        }
    }   
    
    
    public function getsecAction()
    {      
        echo Zend_Json_Encoder::encode($this->getSections());
    }

    
}