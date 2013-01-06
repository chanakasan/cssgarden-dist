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
        $user_id = $this->_getParam('id');
        if($user_id > 0)
        {
            
            $em = $this->_doctrineContainer->getEntityManager();
            $query = $em->createQuery("SELECT u FROM App\Entity\Entry u WHERE u.user_id = :id");
            $query->setParameter("id", $user_id);
            $entries = $query->getResult();

            $query = $em->createQuery("SELECT u FROM App\Entity\User u WHERE u.id = :id");
            $query->setParameter("id", $user_id);
            $user = $query->getResult();

            if(!empty($user))
                $this->view->user = $user[0];
            else
                throw new Exception("user not found for id '$user_id'");

            if(!empty($entries))
                $this->view->entries = $entries;            
            else             
                $this->view->entries = array();                    
        }
        else
            throw new Exception("invalid user id '$user_id'");
    }

    
}

