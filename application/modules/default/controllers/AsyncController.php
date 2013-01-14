<?php

/**
 * Description of AsyncController
 *
 * @author Chanaka
 */
class AsyncController extends Zend_Controller_Action
{

   /*
    * @var Zend_Session_Namespace
    */
    private $_session;

    protected $_doctrineContainer;


    public function init()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }

    public function preDisptch()
    {
        $this->_session = new Zend_Session_Namespace('default');

        if(!$this->_session->view)
                $this->_session->view = $this->view;
    }

    public function loadcityAction()
    {
        $nocity = array('id' => '0' , 'name' => 'Select');

        if($this->getRequest()->isPost())
        {
            $postData = $this->_request->getPost();
            if(isset($postData['sel_area']))
            {
                $id = $postData['sel_area'];
            }
            if($id > 0)
            {
                // retrieve cities list
                $em = $this->_doctrineContainer->getEntityManager();
                $query = $em->createQuery('SELECT a FROM App\Entity\Area a WHERE a.id = :id');
                $query->setParameter('id', $id);
                $area = $query->getResult();
                if(!empty($area))// send result to browser
                {
                    $cities = $area[0]->cities;
                    $list = array();
                    foreach($cities as $city)
                    {
                        $list[] = $city->toArray();                        
                    }                    
                    echo Zend_Json::encode($list);
                }
            }
            else
                echo Zend_Json::encode(array($nocity));
        }
    }   
    
    
    public function loadcustomerAction()
    {
        $no_select = array('id' => '0' , 'name' => 'Select');

        if($this->getRequest()->isPost())
        {
            $postData = $this->_request->getPost();
            if(isset($postData['sel_cat']) && isset($postData['sel_city']))
            {
                $cat_id = $postData['sel_cat'];
                $id = $postData['sel_city'];
            }
            if($cat_id > 0 && $id > 0)
            {
                // get Category name
                $entityAttrib = Model_Categories::getEntityAttrib($cat_id);
                
                $em = $this->_doctrineContainer->getEntityManager();               
                // retrieve customers list                
                $query = $em->createQuery('SELECT c FROM App\Entity\City c WHERE c.id = :id');
                $query->setParameter('id', $id);
                $city = $query->getResult();
                if($entityAttrib && !empty($city))// send result to browser
                {
                    $customers = $city[0]->$entityAttrib;
                    $list = array();
                    foreach($customers as $customer)
                    {
                        $list[] = $customer->toArray();
                    }
                    echo Zend_Json::encode($list);
                }
            }
            else
                echo Zend_Json::encode(array($no_select));
        }
    }

    
}