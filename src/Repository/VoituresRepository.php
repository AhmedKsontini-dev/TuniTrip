<?php

namespace App\Repository;

use App\Entity\Voitures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voitures>
 */
class VoituresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voitures::class);
    }

    public function findFiltered(?string $passengers, ?string $suitcases, ?string $boiteVitesse)
    {
        $qb = $this->createQueryBuilder('v');

        if ($passengers) {
            if ($passengers === '5') {
                $qb->andWhere('v.passengers >= :passengers')
                ->setParameter('passengers', 5);
            } else {
                $qb->andWhere('v.passengers = :passengers')
                ->setParameter('passengers', (int)$passengers);
            }
        }

        if ($suitcases) {
            if ($suitcases === '3') {
                $qb->andWhere('v.suitcases >= :suitcases')
                ->setParameter('suitcases', 3);
            } else {
                $qb->andWhere('v.suitcases = :suitcases')
                ->setParameter('suitcases', (int)$suitcases);
            }
        }

        if ($boiteVitesse) {
            $qb->andWhere('v.boiteVitesse = :boiteVitesse')
            ->setParameter('boiteVitesse', $boiteVitesse);
        }

        return $qb->getQuery()->getResult();
    }

}
