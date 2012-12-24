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

    protected $_password = "pass123";
    protected $_fname = "john";
    protected $_lname = "smith";
    protected $_email = "john@my.com";
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

        $this->_addUser("ajith55");

        $resultAfter = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(1,count($resultAfter));
        //var_dump($resultAfter);
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
        $this->_addUser("chan89");
        $this->_addUser("nimal67");
        $this->_addCategory("Doctor");
        $this->_addCategory("Super Market");
        $this->_addCategory("Pharmacy");
        
        $em = $this->doctrineContainer->getEntityManager();
        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $user1 = $users[0];
        $user2 = $users[1];
        $cats = $em->createQuery('select u from App\Entity\Category u')->execute();
        $cat1 = $cats[0];
        $cat2 = $cats[1];

        $entry1 = new Entry();
        $entry1->dwpno = \date('Ymd').$user1->id+100;
        $entry1->category = "Doctor";
        $entry1->customerInfo = "Mr.Sunil";
        $entry1->visitTime = "10 am";
        $entry1->area = "Colombo";
        $entry1->city = "Colombo 10";
        $entry1->activity = "meeting";
        $entry1->user = $user1;

        $entry2 = new Entry();
        $entry2->dwpno = \date('Ymd').$user1->id+100;
        $entry2->category = "Super Market";
        $entry2->customerInfo = "Mr.Sunil";
        $entry2->visitTime = "10 am";
        $entry2->area = "Colombo";
        $entry2->city = "Colombo 10";
        $entry2->activity = "meeting";
        $entry2->user = $user1;

        $em->persist($entry1);
        $em->persist($entry2);
        $em->flush();
        
        $entries = $em->createQuery('select entry from App\Entity\Entry entry')->execute();
        var_dump($entries);exit;
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

        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->flush();
    }

}

