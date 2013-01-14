<?php
/**
 * Description of CustomerController
 *
 * @author CS
 */
class Admin_CustomerController extends Zend_Controller_Action
{    
    protected $_customerService;

    protected $_doctrineContainer;

    protected $_entity_name;



    public function preDispatch()
    { 
        $this->_customerService = new App_Service_Customer();
        $this->_doctrineContainer = Zend_Registry::get("doctrine");

        if($this->_getParam('cat'))
        {
            $this->_entity_name = ucfirst($this->_getParam('cat'));            
        }
        else
            $this->_entity_name = "no-entity-name";

        $this->view->entity_name = $this->_entity_name;
    }

    public function indexAction()
    {

    }
    
    public function listAction()
    {
        if($this->_getParam("cat"))
        {
            $cat_name = $this->getRequest()->getParam("cat");
            $allCustomers = $this->_customerService->getAllCustomers($cat_name);            
            $this->view->customers = $allCustomers;
        }
    }

    public function addAction()
    {
        $form = new Form_Customer();
        $this->view->form = $form;
                
        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            $entity_name = $this->_entity_name;
            $em = $this->_doctrineContainer->getEntityManager();
            
            $city_id = $formData['city'];
            
            if($form->isValid($formData) && $city_id > 0)
            {
                // get city name from database table
                $query = $em->createQuery("SELECT c FROM App\Entity\City c WHERE c.id = :id");
                $query->setParameter("id", $city_id);
                $city = $query->getResult();

                $entity_class = "\App\Entity\\$entity_name";
                $customer = new $entity_class();
                $customer->name = $formData['name'];
                $customer->address = $formData['address'];
                $customer->phones = $formData['phones'];
                $customer->details = $formData['details'];                                
                $customer->city = $city[0];
                $customer->isactive = $formData['isactive'];

                $city->doctors = array($customer);                
                $em->persist($customer);
                $em->flush();

                $this->_redirect("/admin/c/$this->_entity_name/list");
            }
            else
                $form->populate($formData);
        }   
    }

    public function deleteAction()
    {
        $result = $this->_helper->entities->delete($this->_entity_name);
        if($result === true)
        {
            $this->_redirect("/admin/c/$this->_entity_name/list");
        }
    }


}

