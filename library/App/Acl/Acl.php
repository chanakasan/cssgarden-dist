<?php

class App_Acl_Acl extends Zend_Acl
{
    public function __construct()
    {
        // resources
        $this->add(new Zend_Acl_Resource('admin-page'));
        $this->add(new Zend_Acl_Resource('employee-page'));
        $this->add(new Zend_Acl_Resource('public-page'));
        
        // roles and inheritance
        $this->addRole('guest');
        $this->addRole('employee','guest');
        $this->addRole('admin','employee');        

        // privileges
        $this->allow('guest','public-page');
        $this->allow('admin','admin-page');
        $this->allow('employee','employee-page');

    }
}
