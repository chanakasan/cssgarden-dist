<?php

class Admin_UserController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }

    public function indexAction()
    {
        $em = $this->_doctrineContainer->getEntityManager();
        $users = $em->createQuery('SELECT u FROM App\Entity\User u')->execute();
        $this->view->users = $users;
    }

    public function addAction()
    {
        $this->_perform();
    }


    public function editAction()
    {
        $this->_perform();
    }


    public function deleteAction()
    {
        $this->_perform();
    }

    private function _perform()
    {
        $actionName = $this->getRequest()->getActionName();

        $controllerName = $this->getRequest()->getControllerName();
        $result = $this->_helper->entities->$actionName($controllerName);
        if($result === true)
        {
            $this->_helper->redirector("index");
        }

    }


}