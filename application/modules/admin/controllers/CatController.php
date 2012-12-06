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
    }


    public function indexAction()
    {
        $cat = new \App\Entity\Category();
        $cat->name = "Doctor";        
        $em = $this->_doctrineContainer->getEntityManager();
        $em->persist($cat);
        $em->flush();

        $categories = $em->createQuery("select u from App\Entity\Category u")->execute();
        $this->view->cats = $categories;
    }

    public function addAction()
    {

    }

    public function deleteAction()
    {

    }
}

