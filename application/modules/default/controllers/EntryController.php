<?php

class EntryController extends Zend_Controller_Action
{
    protected $_doctrineContainer;  
    
    public function init()
    {
       $this->_doctrineContainer = Zend_Registry::get("doctrine");
       $this->view->entityName = ucfirst('entry');
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
            $timelimit = "19:00:00";
            $form = $this->_fixForm($temp_form, $timelimit);           

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
        $form = new Form_Entry();
        $form->submit->setLabel('Save');               

        if($this->getRequest()->isPost() && $this->_getParam('id'))
        {
            $formData = $this->getRequest()->getPost();

            if($formData['result'] === null)
                $formData['result'] = "incomplete";
            if($formData['remarks'] === null)
                $formData['remarks'] = "---";

            if($form->isValid($formData))
            {
                $em = $this->_doctrineContainer->getEntityManager();
                $queryString = "UPDATE App\Entity\Entry u
                                    SET u.customer = :customer,
                                        u.customerInfo = :customerInfo,
                                        u.visitTime = :visitTime,
                                        u.area = :area,
                                        u.city = :city,                                        
                                        u.activity = :activity,
                                        u.result = :result,
                                        u.remarks = :remarks
                                    WHERE u.id = :id";

                $query = $em->createQuery($queryString);
                $query->setParameters( array(
                        'id' => $this->_getParam('id'),
                        'customer' => $formData['customer'],
                        'customerInfo' => $formData['customerInfo'],
                        'visitTime' => $formData['visitTime'],
                        'area' => $formData['area'],
                        'city' => $formData['city'],
                        'activity' => $formData['activity'],
                        'result' => $formData['result'],
                        'remarks' => $formData['remarks'],
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
        $result = $form->getElement('result');
        $result->setAttrib("disabled", true);

        $remarks = $form->getElement('remarks');
        $remarks->setAttrib("disabled", true);

        // retrieve customer categories list
        $em = $this->_doctrineContainer->getEntityManager();
        $result = $em->createQuery("SELECT u.id, u.name FROM App\Entity\Category u")->getResult();
        // populate form
        $catElement = $form->getElement('category');
        if(!empty($result))
        {
            foreach($result as $cat)
            {
                $catElement->addMultiOptions(array(
                    $cat['id'] => $cat['name']
                ));
            }
        }

        // retrieve areas list
        $result = array(
            array("id" => "1", "name" => "Colombo"),
            array("id" => "2", "name" => "Gampaha")

        );
        // populate form
        $areaElement = $form->getElement('area');
        if(!empty($result))
        {
            foreach($result as $area)
            {
                $areaElement->addMultiOptions(array(
                    $area['id'] => $area['name']
                ));
            }
        }
        $this->view->form = $form;
        return $form;
    }

    private function _initUpdateForm($form)
    {
        $result = $form->getElement('result');
        $remarks = $form->getElement('remarks');

        $result->setAttrib("disabled", false);
        $remarks->setAttrib("disabled", false);

        $elements = array(
            $form->getElement('category'),
            $form->getElement('customerInfo'),
            $form->getElement('visitTime'),
            $form->getElement('area'),
            $form->getElement('city'),
            $form->getElement('activity'),
        );

        foreach($elements as $element)
        {
            $element->setAttrib("disabled", true)
                    ->setRequired(false);
        }

        return $form;
    }

 
    

}

