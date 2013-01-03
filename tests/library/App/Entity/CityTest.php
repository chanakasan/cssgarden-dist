<?php

namespace App\Entity;
/**
 * @author Chanaka Sandaruwan
 */
class CityTest
    extends \ModelTestCase
{   
 
    public function testCanAddCity()
    {
        $this->assertInstanceOf('App\Entity\City', new City());
    }

    /**
     * @depends testCanAddCity
     */
    public function testRetrieveCities()
    {        
        // retrieve cities list
        $em = $this->doctrineContainer->getEntityManager();
        $cities = $em->createQuery('select c from App\Entity\City c')->execute();

        echo "--- Retrieve Cities ---".\PHP_EOL;
        for($i = 1; $i <= 10; $i++)
        {            
            //var_dump($area);exit;
            echo \PHP_EOL.$cities[$i]->name.\PHP_EOL;
        }
        echo "--- End Retrieve Cities ---".\PHP_EOL;
    }


}

