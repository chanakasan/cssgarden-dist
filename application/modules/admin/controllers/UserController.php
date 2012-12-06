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
        $u->password = "pass123";        
        $u->fname = "John";
        $u->lname = "Smith";        
        $u->email = "noemail@test.com";
        $u->mobile = 0777123456;

        $u2 = new \App\Entity\User();
        $u2->username = "testadmin1";
        $u2->password = "pass123";
        $u2->isadmin = true;
        $u2->fname = "Bob";
        $u2->lname = "Smith";
        $u2->email = "noemail@test.com";
        $u2->mobile = 0777123456;

        $em = $this->_doctrineContainer->getEntityManager();
//        $em->persist($u);
//        $em->persist($u2);
//        $em->flush();
        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->view->users = $users;
    }

    public function addAction()
    {
        $form = new Form_User();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            $password = $formData['password'];
            $password2 = $formData['password2'];
            if($form->isValid($formData) && ($password === $password2) )
            {
                $u = new \App\Entity\User();
                $u->username = $formData['username'];
                $u->password = $formData['password'];                
                $u->fname = $formData['firstname'];
                $u->lname = $formData['lastname'];
                $u->isactive = $formData['isactive'];
                $u->isadmin = $formData['isadmin'];
                $u->email = $formData['email'];
                $u->mobile = $formData['mobile'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($u);
                $em->flush();
                
                $this->_helper->redirector('index');
            }
            else $form->populate($formData);
        }
    }


    public function editAction()
    {
        $form = new Form_User();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $u = new \App\Entity\User();
                $u->username = $formData['username'];
                $u->fname = $formData['firstname'];
                $u->lname = $formData['lastname'];
                $u->email = $formData['email'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($u);
                $em->flush();

                $this->_helper->redirector('index');
            }
            else $form->populate($formData);
        }
        else {
            $id = $this->_getParam('id',0);
            if($id > 0)
            {
             
            }
        }
    }


    public function deleteAction()
    {

    }
}