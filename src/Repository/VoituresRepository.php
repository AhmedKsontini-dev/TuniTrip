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

        // ---- PASSENGERS ----
        if ($passengers) {
            if ($passengers === '6plus') {
                $qb->andWhere('v.passengers >= :p')
                ->setParameter('p', 6);

            } else {
                $qb->andWhere('v.passengers = :p')
                ->setParameter('p', (int)$passengers);
            }
        }

        // ---- SUITCASES ----
        if ($suitcases) {
            if ($suitcases === '4plus') {
                $qb->andWhere('v.suitcases >= :s')
                ->setParameter('s', 4);

            } else {
                $qb->andWhere('v.suitcases = :s')
                ->setParameter('s', (int)$suitcases);
            }
        }

        // ---- BOITE VITESSE ----
        if ($boiteVitesse) {
            $qb->andWhere('v.boiteVitesse = :b')
            ->setParameter('b', $boiteVitesse);
        }

        return $qb->getQuery()->getResult();
    }


    public function findLatestAvailable(int $limit = 3): array
    {
        return $this->createQueryBuilder('v')
            ->where('v.disponible = :dispo')
            ->setParameter('dispo', true)
            ->orderBy('v.id', 'DESC') // ou par date de création si existante
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }



}
