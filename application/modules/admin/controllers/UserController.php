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
        $u = new \App\Entity\User();
        $u->username = "testuser1";
        $u->fname = "John";
        $u->lname = "Smith";
        $u->email = "noemail@test.com";

        $em = $this->_doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->flush();
        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->view->users = $users;
    }

    public function addAction()
    {

    }


    public function editAction()
    {

    }


    public function deleteAction()
    {

    }
}