<?php

namespace App\DataFixtures;

use App\Entity\TrajetTransfert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrajetTransfertSlugFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $transferts = $manager->getRepository(TrajetTransfert::class)->findAll();
        
        foreach ($transferts as $transfert) {
            $transfert->generateSlug();
            $manager->persist($transfert);
        }
        
        $manager->flush();
    }
}