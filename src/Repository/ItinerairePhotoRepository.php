<?php

namespace App\Repository;

use App\Entity\ItinerairePhoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItinerairePhoto>
 */
class ItinerairePhotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItinerairePhoto::class);
    }

    /**
     * Récupère toutes les photos d'un itinéraire spécifique, triées par ordre
     */
    public function findByItineraireOrdered(int $itineraireId): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.itineraire = :itineraireId')
            ->setParameter('itineraireId', $itineraireId)
            ->orderBy('p.ordre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}