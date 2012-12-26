<?php

/**
 * Description of ReportController
 *
 * @author CS
 */
class Admin_ReportController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }

    public function indexAction()
    {        
        
    }

    public function viewAction()
    {
        if($this->_getParam('id') > 0)
        {
            $user_id = $this->_getParam('id');
            $em = $this->_doctrineContainer->getEntityManager();
            $query = $em->createQuery("SELECT u FROM App\Entity\Entry u WHERE u.user_id = :id");
            $query->setParameter("id", $user_id);
            $entries = $query->getResult();

            $query = $em->createQuery("SELECT u FROM App\Entity\User u WHERE u.id = :id");
            $query->setParameter("id", $user_id);
            $user = $query->getResult();

            if(!empty($entries) && !empty($user))
            {
                $this->view->user = $user[0];
                $this->view->entries = $entries;
            }
            else {
                $this->view->nouser = "not selected";
                $this->view->entries = array();
            }            
        }     
    }

    
}

