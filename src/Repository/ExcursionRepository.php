<?php

namespace App\Repository;

use App\Entity\Excursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Excursion>
 */
class ExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Excursion::class);
    }

    /**
     * Retourne les dernières excursions actives
     */
    public function findLastExcursions(int $limit = 4): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.actif = :actif')
            ->setParameter('actif', true)
            ->orderBy('e.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche les excursions avec filtres localisation, catégorie et prix max
     */
    public function findByFilters(?string $localisation, ?string $categorie, ?float $prix)
    {
        $qb = $this->createQueryBuilder('e')
            ->leftJoin('e.images', 'img')      // Charge les images
            ->addSelect('img')
            ->leftJoin('e.inclusList', 'inc')  // Charge inclus
            ->addSelect('inc')
            ->leftJoin('e.nonInclusList', 'ninc') // Charge non inclus
            ->addSelect('ninc')
            ->leftJoin('e.itineraires', 'it')  // Charge itinéraires
            ->addSelect('it')
            
            
            ->where('e.actif = true')
            ->orderBy('e.createdAt', 'DESC');

        if ($localisation) {
            $qb->andWhere('e.localisation = :loc')
               ->setParameter('loc', $localisation);
        }

        if ($categorie) {
            $qb->andWhere('e.categorie = :cat')
               ->setParameter('cat', $categorie);
        }

        if ($prix) {
            $qb->andWhere('e.prixParPersonne <= :prix')
               ->setParameter('prix', $prix);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Retourne les localisations distinctes
     */
    public function findDistinctLocalisations(): array
    {
        return array_column(
            $this->createQueryBuilder('e')
                ->select('DISTINCT e.localisation')
                ->where('e.actif = true')
                ->getQuery()
                ->getScalarResult(),
            'localisation'
        );
    }

    /**
     * Retourne les catégories distinctes
     */
    public function findDistinctCategories(): array
    {
        return array_column(
            $this->createQueryBuilder('e')
                ->select('DISTINCT e.categorie')
                ->where('e.actif = true')
                ->getQuery()
                ->getScalarResult(),
            'categorie'
        );
    }
}
