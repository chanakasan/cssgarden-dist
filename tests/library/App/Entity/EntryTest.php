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
    
    public function testCanCreateEntry()
    {
        $this->assertInstanceOf('App\Entity\Entry', new Entry());
    }

    public function testCanSaveEntryData()
    {
        $entry = new Entry();
        $entry->dwpno = \date('Ymd')."[uid][count]";
        $entry->date = \date('d-m-Y');
        $entry->customer = "example-customer";
        $entry->area = "Colombo";
        $entry->city = "Colombo 10";
        $entry->activity = "interview";
        $entry->result = "";

        $em = $this->doctrineContainer->getEntityManager();
        $em->persist($entry);
        $em->flush();
        $entries = $em->createQuery('select entry from App\Entity\Entry entry')->execute();
        //var_dump($entries);

    }


}

