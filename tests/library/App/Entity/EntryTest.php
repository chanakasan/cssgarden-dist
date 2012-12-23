<?php

namespace App\Entity;
/**
 * Description of UserTest
 *
 * @author jon
 */
class EntryTest
    extends \ModelTestCase
{
    protected $_username = "chan89";
    protected $_password = "pass123";
    protected $_fname = "chanaka";
    protected $_lname = "sandaruwan";
    protected $_email = "chan@my.com";
    protected $_mobile = 0777123456;
    protected $_isadmin = true;

        public function xtestCanCreateEntry()
    {
        $this->assertInstanceOf('App\Entity\Entry', new Entry());
    }

    public function testGetCityList()
    {
        $id = 1;
        // retrieve cities list
        $em = $this->doctrineContainer->getEntityManager();
        $query = $em->createQuery("SELECT a FROM App\Entity\Area a WHERE a.id = :id");
        $query->setParameter("id", $id);
        $area = $query->getResult();
        //var_dump($area);exit;
        echo PHP_EOL.count($area[0]->cities)." cities in ".$area[0]->name;

    }

    protected function _addUser()
    {
        $u = new User();
        $u->username = $this->_username;
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

}

