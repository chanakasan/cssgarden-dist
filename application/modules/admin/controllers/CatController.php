<?php

/**
 * Description of IndexController
 *
 * @author CS
 */
class xxAdmin_CatController extends Zend_Controller_Action
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
                $cat->name = $formData['name'];
                $cat->descrip = $formData['descrip'] ? $formData['descrip'] : "---";
                $cat->isactive = $formData['isactive'];

                $em = $this->_doctrineContainer->getEntityManager();
                $em->persist($cat);
                $em->flush();

                $this->_helper->redirector("index");
            }
            else $form->populate($formData);
        }
    }

    public function deleteAction()
    {
        $result = $this->_helper->entities->delete("Cat");
        if($result === true)
        {
            $this->_helper->redirector("index");
        }
    }
    
}

