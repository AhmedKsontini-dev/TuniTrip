<?php

namespace App\DataFixtures;

use App\Entity\Voitures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class VoitureSlugFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();
        $voitures = $manager->getRepository(Voitures::class)->findAll();
        
        foreach ($voitures as $voiture) {
            $slug = $slugger->slug($voiture->getMarque() . ' ' . $voiture->getModele() . ' ' . $voiture->getId())->lower();
            $voiture->setSlug((string) $slug);
            $manager->persist($voiture);
        }
        
        $manager->flush();
    }
}
