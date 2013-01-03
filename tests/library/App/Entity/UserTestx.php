<?php
namespace App\Entity;
/**
 * @author Chanaka Sandaruwan
 */
class UserTest
    extends \ModelTestCase
{

    protected $_password = "pass123";
    protected $_fname = "john";
    protected $_lname = "smith";
    protected $_email = "john@my.com";
    protected $_mobile = "0777123456";
    protected $_isadmin = true;

    public function testCanCreateUser()
    {
        $this->assertInstanceOf('App\Entity\User', new User());
    }

    public function testCanAddUser()
    {   
        $em = $this->doctrineContainer->getEntityManager();
        $resultBefore = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(0,count($resultBefore));

        $this->_addUser("ajith55");

        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(1,count($resultAfter));
    }

    /**
     * @depends testCanAddUser
     */
    public function xtestCanGetSavedUserData()
    {
        $this->_addUser("kamal54");
        $em = $this->doctrineContainer->getEntityManager();
        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        //var_dump($resultAfter);exit;
        
        $this->assertEquals("kamal54", $resultAfter[0]->username);
        $this->assertEquals($this->_fname, $resultAfter[0]->fname);
        $this->assertEquals($this->_lname, $resultAfter[0]->lname);
        $this->assertEquals($this->_email, $resultAfter[0]->email);
        $this->assertEquals($this->_mobile, $resultAfter[0]->mobile);
        $this->assertEquals($this->_isadmin, $resultAfter[0]->isadmin);
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

    
}

