<?php
namespace App\Repository;

use App\Entity\ReservationExcursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationExcursion::class);
    }

    // Tu peux ajouter ici des fonctions personnalisées pour récupérer les réservations
}
