<?php

/**
 * Description of IndexController
 *
 * @author CS
 */
class Admin_CatController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }


    public function indexAction()
    {      
        $em = $this->_doctrineContainer->getEntityManager();
        $categories = $em->createQuery("select u from App\Entity\Category u")->execute();
        $this->view->cats = $categories;
    }

    public function addAction()
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
        
        $result = $this->_helper->entities->$actionName("Category");
        if($result === true)
        {
            $this->_helper->redirector("index");
        }

    }
}

