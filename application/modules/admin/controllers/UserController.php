<?php

class Admin_UserController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get('doctrine');
       $this->view->entityName = ucfirst('user');
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
                $u->fname = $formData['fname'];
                $u->lname = $formData['lname'];
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

        if($this->getRequest()->isPost() && $this->_getParam('id'))
        {
            $formData = $this->getRequest()->getPost();
            $password = $formData['password'];
            $password2 = $formData['password2'];
            if($form->isValid($formData) && ($password === $password2))
            {                
                $em = $this->_doctrineContainer->getEntityManager();
                $queryString = "UPDATE App\Entity\User u
                                    SET u.username = :username,
                                        u.password = :password,
                                        u.fname = :fname,
                                        u.lname = :lname,
                                        u.isactive = :isactive,
                                        u.isadmin = :isadmin,
                                        u.email = :email,
                                        u.mobile = :mobile
                                    WHERE u.id = :id";
                
                $query = $em->createQuery($queryString);
                $query->setParameters( array(
                        'id' => $this->_getParam('id'),
                        'username' => $formData['username'],
                        'password' => $formData['password'],
                        'fname' => $formData['fname'],
                        'lname' => $formData['lname'],
                        'isactive' => $formData['isactive'],
                        'isadmin' => $formData['isadmin'],
                        'email' => $formData['email'],
                        'mobile' => $formData['mobile'],
                    ));
                $query->getResult();

                $this->_helper->redirector('index');
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
                
                $form->populate($result[0]->toArray());
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

/*
     * update query
     * $user = \Doctrine\Query::create()
                    ->update('Customer')
                    ->set('username', '?', $formData['username'])
                    ->set('password', '?', $formData['password'])
                    ->set('fname', '?', $formData['fname'])
                    ->set('lname', '?', $formData['lname'])
                    ->set('isactive', '?', $formData['isactive'])
                    ->set('isadmin', '?', $formData['isadmin'])
                    ->set('email', '?', $formData['email'])
                    ->set('mobile', '?', $formData['mobile'])
                    ->where('id = ?', $this->_getParam('id'))
                    ->execute();
     */