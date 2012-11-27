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

    public function testCanSaveFirstAndLastNameAndRetrieveThem()
    {
        $u = new User();
        $u->firstname = "John";
        $u->lastname = "Smith";

        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($u);
        $em->flush();

        $users = $em->createQuery('select u from App\Entity\User u')->execute();
        $this->assertEquals(1,count($users));

        $this->assertEquals('John',$users[0]->firstname);
        $this->assertEquals('Smith',$users[0]->lastname);
    }

}

