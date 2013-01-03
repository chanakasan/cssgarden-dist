<?php

namespace App\Entity;
/**
 * @author Chanaka Sandaruwan
 */
class DoctorTest
    extends \ModelTestCase
{   
 
    public function testCanAddDoctor()
    {
        $this->assertInstanceOf('App\Entity\Doctor', new Doctor());
    }

    /**
     * @depends testCanAddDoctor
     */
    public function testCanRetrieveDoctors()
    {
        // retrieve 
        $em = $this->doctrineContainer->getEntityManager();
        $doctors = $em->createQuery("SELECT d FROM App\Entity\Doctor d")->execute();
        echo \PHP_EOL;
        echo \PHP_EOL."--- Retrieve Doctors ---".\PHP_EOL;
        foreach($doctors as $doctor)
        {
            echo $doctor->name.\PHP_EOL;
        }        
        echo "--- End Retrieve Doctors ---".\PHP_EOL;
    }



}

