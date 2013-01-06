<?php

/**
 * Description of Customer
 *
 * @author CS
 */
class App_Service_Customer
{
    protected $_cat_entities;

    protected $_doctrineContainer;

    public function  __construct()
    {
        $this->_cat_entities = Model_Categories::getEntityList();
        $this->_doctrineContainer = Zend_Registry::get("doctrine");
    }

    public function getAllCustomers($cat_name)
    {        
        if($this->_isRequestValid($cat_name))
        {
            $em = $this->_doctrineContainer->getEntityManager();
            $entity_name = ucfirst($cat_name);
            $query = $em->createQuery("SELECT w FROM App\Entity\\$entity_name w");
            $result = $query->getResult();
            
            return $result;
        }
        else
            throw new \Exception("Invalid customer entity name '".\ucfirst($cat_name)."'");
    }

    

    protected function _isRequestValid($cat_name)
    {                   
        foreach($this->_cat_entities as $entity)
        {
            if($entity == ucfirst($cat_name))
            {
                return true;
            }
        }
        return false;
     
    }

    
}