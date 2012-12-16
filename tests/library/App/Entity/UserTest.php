<?php
namespace App\Entity;
/**
 * Description of UserTest
 *
 * @author jon
 */
class UserTest
    extends \ModelTestCase
{
    
    protected $_username = "chan89";
    protected $_password = "pass123";
    protected $_fname = "chanaka";
    protected $_lname = "sandaruwan";
    protected $_email = "chan@my.com";
    protected $_mobile = "0777123456";
    protected $_isadmin = true;

    public function xtestCanCreateUser()
    {
        $this->assertInstanceOf('App\Entity\User', new User());
    }

    public function testCanAddUser()
    {   
        $em = $this->doctrineContainer->getEntityManager();
        $resultBefore = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(0,count($resultBefore));
        //var_dump($resultBefore);exit;

        $this->_addUser();       

        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(1,count($resultAfter));
        //var_dump($resultAfter);
    }

    /**
     * @depends testCanAddUser
     */
    public function xtestCanGetSavedUserData()
    {
        $this->_addUser();        
        $em = $this->doctrineContainer->getEntityManager();
        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        //var_dump($resultAfter);exit;
        
        $this->assertEquals($this->_username, $resultAfter[0]->username);
        $this->assertEquals($this->_fname, $resultAfter[0]->fname);
        $this->assertEquals($this->_lname, $resultAfter[0]->lname);
        $this->assertEquals($this->_email, $resultAfter[0]->email);
        $this->assertEquals($this->_mobile, $resultAfter[0]->mobile);
        $this->assertEquals($this->_isadmin, $resultAfter[0]->isadmin);
    }

    /**
     * @depends testCanAddUser
     */
    public function testCanAddEntry()
    {
        $this->_addUser();
        $em = $this->doctrineContainer->getEntityManager();
        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        //var_dump($resultAfter);exit;
        
        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $loggedInUser = $users[0];

        $entry = new Entry();
        $entry->dwpno = \date('Ymd').$loggedInUser->id+100;
        $entry->customer = "doctor";
        $entry->customerInfo = "Mr.Sunil";
        $entry->visitTime = "10 am";
        $entry->area = "Colombo";
        $entry->city = "Colombo 10";
        $entry->activity = "meeting";
        $entry->user = $users[0];

        $em->persist($entry);
        $em->flush();
        $entries = $em->createQuery('select entry from App\Entity\Entry entry')->execute();
            var_dump($entries);exit;
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

