<?php

class Admin_AuthController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $form = new Form_Login();
        $this->view->form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page                    
                    $this->_helper->redirector('index', 'index');
                }
            }
        }              
    }

    protected function _process($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']);
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject(array(
            'id',
            'role',
            'username'            
            ));
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }

    protected function _getAuthAdapter()
    {   
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('vos_users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    //->setCredentialTreatment('MD5(?) AND active = 1');
                    ->setCredentialTreatment('SHA1(CONCAT(?,salt)) AND role = "admin" AND active = 1');

        return $authAdapter;
    }
    
    public function logoutAction()
    {       
        //clear auth and user sessions
        if(Zend_Auth::getInstance()->hasIdentity()){
            Zend_Auth::getInstance()->clearIdentity();
            Zend_Session::destroy(true, true);
            $this->_helper->redirector('index', 'login'); // back to login page
        }
    }

}



