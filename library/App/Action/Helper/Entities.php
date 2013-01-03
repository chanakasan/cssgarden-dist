<?php

/**
 * Description of Packages
 *
 * @author CS
 */
class App_Action_Helper_Entities
    extends Zend_Controller_Action_Helper_Abstract
{
    /**
    * @var DoctrineContainer
    */
    protected $_doctrineContainer;

   /**
    * @var Zend_Session_Namespace
    */
    protected $_session;
    /*
     * @var Zend_View
     */
    protected $_view;

    public function preDispatch()
    {
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
    }

    protected function _getView()
    {
        if (null !== $this->_view)
        {
            return $this->_view;
        }
        $controller = $this->getActionController();
        $this->_view = $controller->view;
        return $this->_view;
    }

    public function delete($entityName)
    {
        $em = $this->_doctrineContainer->getEntityManager();
        if($this->getRequest()->isPost())
        {
            $del = $_POST['del'];
            if ("Yes" === $del && isset($_POST['id']))
            {
                $id = $_POST['id'];
                $query = $em->createQuery("DELETE App\Entity\\".ucfirst($entityName)." u WHERE u.id = :id");
                $query->setParameter("id", $id);
                $query->execute();
            }
            return true;
        }
        else
        {
            $id = $this->getRequest()->getParam('id',0);
            if($id > 0)
            {
                $query = $em->createQuery("SELECT u FROM App\Entity\\".ucfirst($entityName)." u WHERE u.id = :id");
                $query->setParameter("id", $id);
                $result = $query->getResult();
                $attrib = strtolower($entityName);
                // get current view
                $view = $this->_getView();
                $view->$attrib = $result[0];
            }
        }
    }

    
}
