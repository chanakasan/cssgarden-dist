<?php

namespace App\Entity;
/**
 * @author Chanaka Sandaruwan
 */
class EntryTest
    extends \ModelTestCase
{    
    protected $_password = "pass123";
    protected $_fname = "chanaka";
    protected $_lname = "sandaruwan";
    protected $_email = "chan@my.com";
    protected $_mobile = 0777123456;
    protected $_isadmin = true;

    public function testCanCreateEntry()
    {
        $this->assertInstanceOf('App\Entity\Entry', new Entry());
    }    

    /**
     * @depends testCanCreateEntry
     */
    public function testCanAddEntry()
    {
//        $this->_addUser("kamal78");
//        $this->_addUser("nimal67");
//        $this->_addCategory("Doctor");
//        $this->_addCategory("SuperMarket");
//        $this->_addCategory("Salon");

        $em = $this->doctrineContainer->getEntityManager();
        $users = $em->createQuery('select u from App\Entity\User u')->execute();        
        //var_dump($users[0);exit;

        $cats = $em->createQuery('select c from App\Entity\Category c')->execute();        
        var_dump($cats[0]);exit;

        $cities = $em->createQuery('select c from App\Entity\City c')->execute();
        var_dump($cities[0]);exit;

        $entity = $cats[0]->entityName;        
        // get customer name from database table
        $custmrs = $em->createQuery("SELECT w FROM App\Entity\\$entity w")->execute();
        var_dump($custmrs[0]);exit;

        $entry1 = new Entry();
        $entry1->dwpno = \date('Ymd').($users[0]->id+100);
        $entry1->category = $cats[0]->name;
        $entry1->customer = $custmrs[0]->name;
        $entry1->customerInfo = "Mr.Sunil";
        $entry1->visitTime = "10 am";
        $entry1->area = "Colombo";
        $entry1->city = "Colombo 10";
        $entry1->activity = "meeting";
        $entry1->userid = $users[0]->id;
        
        $em->persist($entry1);
        $em->flush();
    }

    protected function _addUser($username)
    {
        $u = new User();
        $u->username = $username;
        $u->password = $this->_password;
        $u->fname = $this->_fname;
        $u->lname = $this->_lname;
        $u->email = $this->_email;
        $u->mobile = $this->_mobile;
        $u->isadmin = $this->_isadmin;

        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->flush();
    }

    protected function _addCategory($name)
    {
        $u = new Category();
        $u->name = $name;
        $u->entityName = ucfirst($name);
        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->flush();
    }
    

}

