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
        $this->view->entries = $entries;                
    }

    public function addAction()
    {
        $timeLimit ="20:00:00";
        if (time() < strtotime($timeLimit))
        {
            $form = new Form_Entry();
            $form->submit->setLabel("Add");

            $result = $form->getElement('result');
            $result->setAttrib("disabled", true);

            $remarks = $form->getElement('remarks');
            $remarks->setAttrib("disabled", true);

            $category = $form->getElement('category');

            //retrieve sustomer categories
            $em = $this->_doctrineContainer->getEntityManager();
            $result = $em->createQuery("SELECT u.id, u.name FROM App\Entity\Category u")->execute();
            //var_dump($result);exit;

            if(!empty($result))
            {
                foreach($result as $cat)
                {
                    $category->addMultiOptions(array(
                        $cat['id'] => $cat['name']
                    ));
                }
            }
            $this->view->form = $form;
        }

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            $user = Model_Users::getLoggedInUser();
            

            if($form->isValid($formData))
            {
                $entry = new \App\Entity\Entry();
                $entry->dwpno = date("dmY");
                $entry->category = $formData["category"];
                $entry->customerInfo = $formData["customerInfo"];
                $entry->visitTime = $formData["visitTime"];
                $entry->area = $formData["area"];
                $entry->city = $formData["city"];
                $entry->activity = $formData["activity"];
                $entry->user = $user;

                $em->persist($entry);
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
        
        //$result = $form->getElement('result');
        //$result->setAttrib("disabled", true);

        //$remarks = $form->getElement('remarks');
        //$remarks->setAttrib("disabled", true);

        $timeLimit ="16:00:00";
        if (time() >= strtotime($timeLimit))
        {
            
            //$result->setAttrib("disabled", false);
            //$remarks->setAttrib("disabled", false);

            $elements = array(
                $form->getElement('customer'),
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
        }

        $this->view->form = $form;

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

}