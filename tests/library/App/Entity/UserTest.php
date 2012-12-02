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
    
    public function testCanCreateUser()
    {
        $this->assertInstanceOf('App\Entity\User',new User());
    }

    public function testCanSaveUserData()
    {
        $u = new User();        
        $u->username = "testuser1";
        $u->fname = "John";
        $u->lname = "Smith";
        $u->email = "noemail@test.com";

        $u2 = new User();
        $u2->username = "testuser2";
        $u2->fname = "John2";
        $u2->lname = "Smith2";
        $u2->email = "noemail@test.com";

        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->persist($u2);
        $em->flush();

        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(2,count($users));

        $this->assertEquals('testuser1',$users[0]->username);
        $this->assertEquals('John',$users[0]->fname);
        $this->assertEquals('Smith',$users[0]->lname);
        $this->assertEquals("noemail@test.com", $users[0]->email);        
    }
}

