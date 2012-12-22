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
        $this->_session = new Zend_Session_Namespace('default');

        if(!$this->_session->view)
                $this->_session->view = $this->view;
    }

    public function loadcityAction()
    {
        $result[1] = array(
                    array("id" => "1", "area_id"=>"1", "name" => "Colombo 1"),
                    array("id" => "2", "area_id"=>"1", "name" => "Colombo 2"),
                    array("id" => "3", "area_id"=>"1", "name" => "Colombo 3"),
                );
        $result[2] = array(
                    array("id" => "4", "area_id"=>"2", "name" => "Abepussa"),
                    array("id" => "5", "area_id"=>"2", "name" => "Biyagama"),
                    array("id" => "6", "area_id"=>"2", "name" => "Dalugama")
                );
        $nocity = array("id" => "0" , "name" => "Select an area");

        if($this->getRequest()->isPost())
        {
            $postData = $this->_request->getPost();
            if(isset($postData['sel_area']))
            {
                $id = $postData['sel_area'];
            }
            if($id > 0 && $id < 3)
            {
                echo Zend_Json::encode($result[$id]);
            }
            else
                echo Zend_Json::encode(array($nocity));
        }
    }   
    
    
    public function getsecAction()
    {      
       
    }

    
}