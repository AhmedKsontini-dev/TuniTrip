<?php

namespace App\Repository;

use App\Entity\ReservationVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationVoiture>
 */
class ReservationVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationVoiture::class);
    }

    // Ici tu peux ajouter tes méthodes personnalisées
}
