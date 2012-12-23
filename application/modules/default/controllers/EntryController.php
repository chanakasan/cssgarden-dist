<?php

class EntryController extends Zend_Controller_Action
{

    protected $_doctrineContainer;
    protected $_timelimit;

    
    
    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get("doctrine");
       $this->view->entityName = ucfirst('entry');
       $this->_timelimit = "19:00:00";
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
            $form = $this->_fixForm($temp_form, $this->_timelimit);

            // POST for submitting form
            if($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                $user = Model_Users::getLoggedInUser(); // current user object
                $cat_id = $formData["category"]; // selected category
                //var_dump($cat_id);exit;
                //var_dump($formData);exit;

                if($form->isValid($formData))
                {
                    $entry = new \App\Entity\Entry();
                    $entry->dwpno = date("dmY");
                    $entry->customerInfo = $formData["customerInfo"];
                    $entry->visitTime = $formData["visitTime"];
                    $entry->area = $formData["area"];
                    $entry->city = $formData["city"];
                    $entry->activity = $formData["activity"];

                    // retrieve selected category object
                    $em = $this->_doctrineContainer->getEntityManager();
                    $query = $em->createQuery("SELECT u FROM App\Entity\Category u WHERE u.id = :id");
                    $query->setParameter("id", $cat_id);
                    $result = $query->getResult();
                    if(!empty($result))
                        $cat = $result[0];
                    //var_dump($result[0);exit;
                                        
                    
                    $user->entries = array($entry);
                    $cat->entries = array($entry);

                    $em = $this->_doctrineContainer->getEntityManager();
                    $em->persist($user);
                    $em->persist($cat);
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

        $form->_fixForm($temp_form, $this->_time_limit);

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
        $this->view->form = $form;
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

    private function _fixForm($temp_form, $timelimit)
    {
        if(time() >= strtotime($timelimit)) // update result mode
        {
            $form = $this->_initUpdateForm($temp_form);
        }
        else // add entry mode
        {
            $form = $this->_initEntryForm($temp_form);

        }
        return $form;
    }

    private function _initEntryForm($form)
    {
        $form->populateCategoryList()
             ->populateAreaList();

        // disable result list
        $result = $form->getElement('result');
        $result->setAttrib("disabled", true);

        // disable remarks box
        $remarks = $form->getElement('remarks');
        $remarks->setAttrib("disabled", true);

        $this->view->form = $form;
        return $form;
    }

    private function _initUpdateForm($form)
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

