<?php

/**
 * Description of IndexController
 *
 * @author CS
 */
class Admin_CatController extends Zend_Controller_Action
{
    protected $_doctrineContainer;

    public function init()
    {
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->view->entityName = ucfirst('category');
    }


    public function indexAction()
    {      
        $em = $this->_doctrineContainer->getEntityManager();
        $categories = $em->createQuery("SELECT u FROM App\Entity\Category u")->execute();
        $this->view->cats = $categories;
    }

    public function addAction()
    {
        $form = new Form_Category();
        $form->submit->setLabel('Add');        
        $this->view->form = $form;

        if($this->getRequest()->isPost())
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData))
            {
                $cat = new \App\Entity\Category();
                $cat->name = $formData['cat_name'];
                $cat->descrip = $formData['cat_desc'];
                $cat->isactive = $formData['isactive'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($cat);
                $em->flush();

                return true;
            }
            else $form->populate($formData);
        }
    }

    public function deleteAction()
    {
        $this->_perform();
    }

    private function _perform()
    {
        $actionName = $this->getRequest()->getActionName();
        
        $result = $this->_helper->entities->$actionName("Category");
        if($result === true)
        {
            $this->_helper->redirector("index");
        }

    }
}

