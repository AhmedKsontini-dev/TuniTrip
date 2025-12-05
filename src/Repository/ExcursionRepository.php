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
     * Recherche les excursions avec filtres localisation, catégorie, prix max, durée, note, langue et nombre max de personnes
     */
    public function findByFilters(
        ?string $localisation,
        ?string $categorie,
        ?float $prix,
        ?string $duree,
        ?int $rating,
        ?string $langue,
        ?int $maxPers
    )
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
            ->leftJoin('e.avis', 'av')        // Pour filtrer sur la note moyenne
            ->addSelect('av')
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

        if ($duree) {
            // On filtre simplement sur la valeur de la colonne duree ("1", "2", "3", "4+", ...)
            $qb->andWhere('e.duree = :duree')
               ->setParameter('duree', $duree);
        }

        if ($langue) {
            // Le champ "guide" peut contenir le code langue (fr, en, ...)
            $qb->andWhere('e.guide = :langue')
               ->setParameter('langue', $langue);
        }

        if ($maxPers) {
            $qb->andWhere('e.maxPers <= :maxPers')
               ->setParameter('maxPers', $maxPers);
        }

        if ($rating) {
            // Filtrer les excursions dont la moyenne des notes est >= rating
            $qb->groupBy('e.id')
               ->having('AVG(av.note) >= :rating')
               ->setParameter('rating', $rating);
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
