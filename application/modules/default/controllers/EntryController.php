<?php

class EntryController extends Zend_Controller_Action
{

    protected $_doctrineContainer;
    protected $_timelimit;

    
    
    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get("doctrine");
       $this->view->entityName = ucfirst('entry');
       $this->_timelimit = "13:00:00";
    }

    public function indexAction()
    {
        $em = $this->_doctrineContainer->getEntityManager();

        $entries = $em->createQuery("SELECT u FROM App\Entity\Entry u")->execute();
        //var_dump($entries);exit;
        $this->view->entries = $entries;
    }

    public function addAction()
    {
            $temp_form = new Form_Entry();
            $temp_form->submit->setLabel("Add");
            if(time() < strtotime($this->_timelimit)) // new entry mode
            {
               $form = $this->_initNewEntry($temp_form);
               $this->view->form = $form;
            }            

            // POST for submitting form
            if($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                //var_dump($formData);exit;

                $user = Model_Users::getLoggedInUser(); // current user object
                
                if($form->isValid($formData) && $user)
                {
                    $entry = new \App\Entity\Entry();
                    $entry->dwpno = date("dmY").($user->id+100);
                    $entry->cat_id = $formData["category"];
                    $entry->customerInfo = $formData["customerInfo"];
                    $entry->visitTime = $formData["visitTime"];
                    $entry->area_id = $formData["area"];
                    $entry->city_id = $formData["city"];
                    $entry->activity = $formData["activity"];
                    $entry->user_id = $user->id;
                    
                    $em = $this->_doctrineContainer->getEntityManager();
                    $em->persist($entry);
                    //var_dump($entry);exit;                                     
                    $em->flush();
                    
                    $this->_helper->redirector("index");
                }
                else $form->populate($formData);
            }            
    }


    public function updateAction()
    {
        $temp_form = new Form_Entry();
        $temp_form->submit->setLabel('Save');
        $form = $temp_form;
        
        if(time() >= strtotime($this->_timelimit)) // update result mode
        {
            $form = $this->_initUpdateResult($temp_form);
            $this->view->form = $form;
        }

        if($this->getRequest()->isPost() && $this->_getParam('id'))
        {
            $formData = $this->getRequest()->getPost();

            if($formData['result'] === null)
                $formData['result'] = "incomplete";
            if($formData['remarks'] === null)
                $formData['remarks'] = "---";

            if($form->isValid($formData))
            {
                $form->update($formData); // update with new data
                $this->_helper->redirector('index'); // redirect to index
            }
            else $form->populate($formData);
            
        }
        else {
            $id = $this->getRequest()->getParam('id',0);
            if($id > 0)
            {
                $em = $this->_doctrineContainer->getEntityManager();
                $query = $em->createQuery("SELECT u FROM App\Entity\Entry u WHERE u.id = :id");
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
    
    private function _initNewEntry($form)
    {
        $form->populateCategoryList()
             ->populateAreaList();

        // disable result list
        $result = $form->getElement('result');
        $result->setAttrib("disabled", true);

        // disable remarks box
        $remarks = $form->getElement('remarks');
        $remarks->setAttrib("disabled", true);
        
        return $form;
    }

    private function _initUpdateResult($form)
    {   
        // enable result list
        $result = $form->getElement('result');
        $result->setAttrib("disabled", false);

        // enable remarks box
        $remarks = $form->getElement('remarks');
        $remarks->setAttrib("disabled", false);

        // get other form elements
        $elements = array(
            $form->getElement('category'),
            $form->getElement('customerInfo'),
            $form->getElement('visitTime'),
            $form->getElement('area'),
            $form->getElement('city'),
            $form->getElement('activity'),
        );
        foreach($elements as $element)// disable other form elements
        {
            $element->setAttrib("disabled", true)
                    ->setRequired(false);
        }
        return $form;
    }

 
    

}

