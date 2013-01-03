<?php

namespace App\Entity;
/**
 * @author Chanaka Sandaruwan
 */
class AreaTest
    extends \ModelTestCase
{   
 
    public function testCanAddArea()
    {
        $this->assertInstanceOf('App\Entity\Area', new Area());
    }

    /**
     * @depends testCanAddArea
     */
    public function testCanRetrieveAreas()
    {
        // retrieve areas
        $em = $this->doctrineContainer->getEntityManager();
        $areas = $em->createQuery("SELECT a FROM App\Entity\Area a")->execute();
        echo \PHP_EOL;
        echo \PHP_EOL."--- Retrieve Areas ---".\PHP_EOL;
        for($i = 0; $i < 24; $i++)
        {
            echo $areas[$i]->name.\PHP_EOL;                     
        }        
        echo "--- End Retrieve Areas ---".\PHP_EOL;
    }

    /**
     * @depends testCanRetrieveAreas
     */
    public function testCanGetCityList()
    {        
        // retrieve cities list        
        $em = $this->doctrineContainer->getEntityManager();
        $areas = $em->createQuery("SELECT a FROM App\Entity\Area a")->execute();
        echo \PHP_EOL;
        echo \PHP_EOL."--- Retrieve CityList ---".\PHP_EOL;
        for($i = 0; $i < 24; $i++)
        {            
            echo count($areas[$i]->cities)." cities in ".$areas[$i]->name.\PHP_EOL;
        }        
        echo "--- End CityList ---".\PHP_EOL;
    }


}

