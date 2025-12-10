<?php

namespace App\Repository;

use App\Entity\ItineraireExcursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ItineraireExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItineraireExcursion::class);
    }

    // Ajoute ici tes méthodes custom si besoin
}
