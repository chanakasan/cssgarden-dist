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
/*
    public function edit($entityName)
    {
        $form = new Form_User();
        $form->submit->setLabel('Save');
        $view = $this->_getView();
        $view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();            
            if($form->isValid($formData))
            {
                $u = new \App\Entity\User();
                $u->username = $formData['username'];
                $u->password = $formData['password'];
                $u->fname = $formData['firstname'];
                $u->lname = $formData['lastname'];
                $u->isactive = $formData['isactive'];
                $u->isadmin = $formData['isadmin'];
                $u->email = $formData['email'];
                $u->mobile = $formData['mobile'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($u);
                $em->flush();

                return true;
            }
            else $form->populate($formData);
        }
        else {
            $id = $this->getRequest()->getParam('id',0);
            if($id > 0)
            {
                $em = $this->_doctrineContainer->getEntityManager();
                $query = $em->createQuery("SELECT u FROM App\Entity\\".ucfirst($entityName)." u WHERE u.id = :id");
                $query->setParameter("id", $id);
                $result = $query->getResult();
                $form->populate($result);
            }
        }
    }

    public function add($entityName)
    {
        $formName = "Form_".ucfirst($entityName);
        $form = new $formName();
        $form->submit->setLabel('Add');
        $view = $this->_getView();
        $view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $u = new \App\Entity\User();
                $u->username = $formData['username'];
                $u->password = $formData['password'];
                $u->fname = $formData['firstname'];
                $u->lname = $formData['lastname'];
                $u->isactive = $formData['isactive'];
                $u->isadmin = $formData['isadmin'];
                $u->email = $formData['email'];
                $u->mobile = $formData['mobile'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($u);
                $em->flush();

                return true;
            }
            else $form->populate($formData);
        }
    }
*/
    
}
