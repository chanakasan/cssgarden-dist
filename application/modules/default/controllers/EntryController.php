<?php

class EntryController extends Zend_Controller_Action
{
    protected $_doctrineContainer;  
    
    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get("doctrine");
    }

    public function indexAction()
    {
        $entry = new \App\Entity\Entry();
        $entry->dwpno = date("dmY");
        $entry->customer = "example-customer";
        $entry->customerInfo = "contact no: 0777 123 456";
        $entry->visitTIme = "10 p.m.";
        $entry->area = "Colombo";
        $entry->city = "Colombo 10";
        $entry->activity = "interview";
        $entry->result = "";

        $em = $this->_doctrineContainer->getEntityManager();
        $em->persist($entry);
        $em->flush();

        $entries = $em->createQuery("select u from App\Entity\Entry u")->execute();
        $this->view->entries = $entries;                
    }

    public function addAction()
    {
        $form = new Form_Entry();
        $form->submit->setLabel("Add");
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $entry = new \App\Entity\Entry();
                $entry->dwpno = date("dmY");
                $entry->customer = $formData["customer"];
                $entry->customerInfo = $formData["customerInfo"];
                $entry->visitTime = $formData["visitTime"];
                $entry->area = $formData["area"];
                $entry->city = $formData["city"];
                $entry->activity = $formData["activity"];
                $entry->result = $formData["result"];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($entry);
                $em->flush();

                $this->_helper->redirector("index");
            }
            else $form->populate($formData);
        }
    }


    public function editAction()
    {
        $form = new Form_Entry();
        $form->submit->setLabel("Save");
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
            $id = $this->_getParam("id",0);
            if($id > 0)
            {
               
            }
        }
    }


    public function deleteAction()
    {

    }
}