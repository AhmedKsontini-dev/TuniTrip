<?php

namespace App\DataFixtures;

use App\Entity\Excursion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ExcursionSlugFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();
        $excursions = $manager->getRepository(Excursion::class)->findAll();
        
        foreach ($excursions as $excursion) {
            // Générer un slug basé sur le titre et l'ID pour l'unicité
            $slug = $slugger->slug($excursion->getTitre() . ' ' . $excursion->getId())->lower();
            $excursion->setSlug((string) $slug);
            $manager->persist($excursion);
        }
        
        $manager->flush();
    }
}