<?php

class EntryController extends Zend_Controller_Action
{
    protected $_doctrineContainer;
    protected $_timelimit;
    
    
    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get("doctrine");
       $this->view->entityName = ucfirst('entry');
       $this->_timelimit = "14:10:00";
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

                $cat_id = $formData["category"];
                $custmr_id = $formData["customer"];
                $area_id = $formData["area"];
                $city_id = $formData["city"];
      
                if($form->isValid($formData) && ($cat_id > 0) && ($custmr_id > 0) && ($area_id > 0) && ($city_id > 0))
                {
                    $em = $this->_doctrineContainer->getEntityManager();

                    // get category name
                    $catname = Model_Categories::getCategoryName($cat_id);

                    $custmr_entity = Model_Categories::getEntityName($cat_id);
                    // get customer name from database table
                    $query = $em->createQuery("SELECT c FROM App\Entity\\$custmr_entity c WHERE c.id = :id");
                    $query->setParameter("id", $custmr_id);
                    $custmrs = $query->getResult();
                    
                    // get area name from database table
                    $query = $em->createQuery("SELECT a FROM App\Entity\Area a WHERE a.id = :id");
                    $query->setParameter("id", $area_id);
                    $areas = $query->getResult();
                    
                    // get city name from database table
                    $query = $em->createQuery("SELECT c FROM App\Entity\City c WHERE c.id = :id");
                    $query->setParameter("id", $city_id);
                    $cities = $query->getResult();

                    $user = Model_Users::getLoggedInUser(); // current user object

                    $entry = new \App\Entity\Entry();
                    $entry->dwpno = date("dmY").($user->id+100);
                    $entry->cat = $catname;
                    $entry->customer = $custmrs[0]->name;
                    $entry->customerInfo = $formData["customerInfo"];
                    $entry->visitTime = $formData["visitTime"];
                    $entry->area = $areas[0]->name;
                    $entry->city = $cities[0]->name;
                    $entry->activity = $formData["activity"];
                    $entry->user_id = $user->id;
                                        
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
        $temp_form->submit->setLabel('Update');
        //$form = $temp_form;
                
        if(time() >= strtotime($this->_timelimit)) // update result mode
        {
            $form = $this->_initUpdateResult($temp_form);
            $this->view->form = $form;
        

            if($this->getRequest()->isPost() && $this->_getParam('id')) // submit form
            {
                $formData = $this->getRequest()->getPost();
                $formData["hidden_id"] = $this->_getParam('id');

                if($form->isValid($formData))
                {
                    $form->updateResult($formData); // update with new data
                    $this->_helper->redirector('index'); // redirect to index
                }
                else $form->populate($formData);

            }
            else {
                $entry_id = $this->_getParam('id',0); // display form
                if($entry_id > 0)
                {
                    $em = $this->_doctrineContainer->getEntityManager();
                    $query = $em->createQuery("SELECT u FROM App\Entity\Entry u WHERE u.id = :id");
                    $query->setParameter("id", $entry_id);
                    $result = $query->getResult();

                    $form->populate($result[0]->toArray());
                }
            }
        }        
    }

    public function deleteAction()
    {
        $result = $this->_helper->entities->delete("Entry");
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
        $result->setAttrib("disabled", 0);

        // enable remarks box
        $remarks = $form->getElement('remarks');
        $remarks->setAttrib("disabled", 0);

        // get other form elements
        $elements = array(
            $form->getElement('category'),
            $form->getElement('area'),
            $form->getElement('city'),
            $form->getElement('customer'),
            $form->getElement('customerInfo'),
            $form->getElement('visitTime'),            
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

