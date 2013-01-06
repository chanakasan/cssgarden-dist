<?php

/**
 * Description of CustomerController
 *
 * @author CS
 */
class Admin_CustomerController extends Zend_Controller_Action
{    
    protected $_customerService;

    protected $_entity_name;



    public function preDispatch()
    { 
        $this->_customerService = new App_Service_Customer();
        if($this->_getParam('cat'))
        {
            $this->_entity_name = ucfirst($this->_getParam('cat'));            
        }
        else
            $this->_entity_name = "no-entity-name";

        $this->view->entity_name = $this->_entity_name;
    }

    public function indexAction()
    {

    }
    
    public function listAction()
    {
        if($this->_getParam("cat"))
        {
            $cat_name = $this->getRequest()->getParam("cat");
            $allCustomers = $this->_customerService->getAllCustomers($cat_name);            
            $this->view->customers = $allCustomers;
        }
    }

    public function addAction()
    {
        $form = new Form_Customer();
        $this->view->form = $form;
        if($this->getRequest()->isPost())
        {
            
        }
    }

    public function deleteAction()
    {
        $result = $this->_helper->entities->delete($this->_entity_name);
        if($result === true)
        {
            $this->_redirect("/admin/c/$this->_entity_name/list");
        }
    }


}

