<?php

class AuthController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $form = new Form_Login();
        $this->view->form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_processAuth($form->getValues())) {
                    // We're authenticated! Redirect to the home page                    
                    $this->_helper->redirector('index', 'index');
                }
            }
        }              
    }

    protected function _processAuth($values)
    {        
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username'])
                ->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        
        if ($result->isValid())
        {
            $user = $adapter->getResultRowObject();            
            $auth->getStorage()->write($user);
            return true;
        }        
        return false;
    }

    protected function _getAuthAdapter()
    {
        $doctrineContainer = Zend_Registry::get('doctrine');
        $authAdapter = new App_Auth_Doctrine_Adapter($doctrineContainer->getEntityManager());
        
        $authAdapter->setEntityName('App\Entity\User')
                ->setIdentityColumn('username')
                ->setCredentialColumn('password');
        
        return $authAdapter;
    }

    public function logoutAction()
    {       
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }

}



