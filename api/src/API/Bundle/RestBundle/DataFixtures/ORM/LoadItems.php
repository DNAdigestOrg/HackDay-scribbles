<?php

namespace API\Bundle\RestBundle\DataFixtures\ORM;

use API\Bundle\RestBundle\Entity\Item;
use API\Bundle\RestBundle\Entity\Owner;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadItems implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->createItem1($manager);
        $this->createItem2($manager);
    }

    private function createItem1($manager)
    {
        $owner = new Owner();
        $owner->setFirstName("Fiona");
        $owner->setLastName("Nielson");
        $owner->setType(Owner::OWNER_TYPE_INDIVIDUAL);
        $owner->setAddressLine1("line1");
        $owner->setAddressLine2("line2");
        $owner->setCity("city");
        $owner->setCountry("UK");

        $item = new Item();
        $item->setAccessType(Item::ACCESS_TYPE_PUBLIC);
        $item->setDescription("This one talks about cancer");
        $item->setFileFormat("hfx");
        $item->setFrequency(70);
        $item->setGender("Male");
        $item->setHost("Cambridge Genetic Research Center");
        $item->setLocation("Cambridge");
        $item->setNoOfAccessRequests(10);
        $item->setNoOfViews(5);
        $item->setOwner($owner);
        $item->setSampleSize(10000);
        $item->setSampleType("RNA");
        $item->setPopulation("African Caribbeans in Barbados");
        $item->setTechnology("Illumina");
        $item->setStudyTitle("Comparative research on exome mutations in some people who I dont know");
        $item->setSummary("I am tired of writing this");
        $item->setTagCloud("cancer, space, play, win");

        $manager->persist($item);
        $manager->flush();
    }

    private function createItem2($manager)
    {
        $owner = new Owner();
        $owner->setOrganizationName("Commercial Company");
        $owner->setType(Owner::OWNER_TYPE_COMMERCIAL_ORGANIZATION);
        $owner->setAddressLine1("line1");
        $owner->setAddressLine2("line2");
        $owner->setCity("city");
        $owner->setCountry("UK");

        $item = new Item();
        $item->setAccessType(Item::ACCESS_TYPE_PUBLIC);
        $item->setDescription("This one talks about genetics");
        $item->setFileFormat("hfx");
        $item->setFrequency(20);
        $item->setHost("Some Company");
        $item->setLocation("London");
        $item->setNoOfAccessRequests(100);
        $item->setNoOfViews(50);
        $item->setOwner($owner);
        $item->setSampleSize(100000);
        $item->setSampleType("RNA");
        $item->setPopulation("American Caribbeans in Barbados");
        $item->setTechnology("Illumina");
        $item->setStudyTitle("A different research on genome mutations - awesome!");
        $item->setSummary("I am tired of writing this");
        $item->setTagCloud("genomics, space, play, win");

        $manager->persist($item);
        $manager->flush();
    }
} 