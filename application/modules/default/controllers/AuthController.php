<?php

class AuthController extends Zend_Controller_Action
{
    protected $_username = 'testuser';
    protected $_password = 'dcrpass123';

    public function indexAction()
    {
        $form = new Form_Login();
        $this->view->form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page
                    $session = new Zend_Session_Namespace('default');
                    $session->authenticated = true;
                    $this->_helper->redirector('index', 'index');
                }
            }
        }              
    }

    protected function _process($values)
    {
        if ($this->_username == $values['username'] && $this->_password == $values['password'])
        {
            return true;
        }
        else
            return false;
    }

    
    public function logoutAction()
    {       
        //clear auth and user sessions
        if($session->authenticated)
        {
            $session->authenticated = false;
            $this->_helper->redirector('index', 'login'); // back to login page
        }
    }

}



