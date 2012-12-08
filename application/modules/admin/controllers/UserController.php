<?php

class Admin_UserController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get('doctrine');
       $this->view->entityName = ucfirst('category');
    }

    public function indexAction()
    {
        $em = $this->_doctrineContainer->getEntityManager();
        $users = $em->createQuery('SELECT u FROM App\Entity\User u')->execute();
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
            if($form->isValid($formData) && ($password === $password2))
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
            $password = $formData['password'];
            $password2 = $formData['password2'];
            if($form->isValid($formData) && ($password === $password2))
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

                return true;
            }
            else $form->populate($formData);
        }
        else {
            $id = $this->getRequest()->getParam('id',0);
            if($id > 0)
            {
                $em = $this->_doctrineContainer->getEntityManager();
                $query = $em->createQuery("SELECT u FROM App\Entity\User u WHERE u.id = :id");
                $query->setParameter("id", $id);
                $result = $query->getResult();
                $resultArray = array();
                $resultArray = (array) $result[0];
                $form->populate($resultArray);
            }
        }
        
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