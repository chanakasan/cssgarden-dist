<?php

class EntryController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }

    public function indexAction()
    {
        $entry = new \App\Entity\Entry();
        $entry->dwpno = date('dmY');
        $entry->date = date('d-m-Y');
        $entry->customer = "example-customer";
        $entry->area = "Colombo";
        $entry->city = "Colombo 10";
        $entry->activity = "interview";
        $entry->result = "";

        $em = $this->_doctrineContainer->getEntityManager();
        $em->persist($entry);
        $em->flush();
        $entries = $em->createQuery('select entry from App\Entity\Entry entry')->execute();
        $this->view->entries = $entries;
    }

    public function addAction()
    {
        $form = new Form_Entry();
        $form->submit->setLabel('Add');
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
             
            }
            else $form->populate($formData);
        }
    }


    public function editAction()
    {
        $form = new Form_Entry();
        $form->submit->setLabel('Save');
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
      
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