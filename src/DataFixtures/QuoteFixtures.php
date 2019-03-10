<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class QuoteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quote = new Quote();
        $quote->setReferenceNumber('123ABCD');
        $quote->setDescription('Test Description');
        $quote->setPremiumAmount(1000);
        $quote->setDateCreated(new \DateTime());

        $manager->persist($quote);
        $manager->flush();
    }
}
