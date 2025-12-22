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
        ?int $maxPers,
        ?int $limit = null,
        ?int $offset = null
    ) {
        // D'abord, on récupère les IDs des excursions qui correspondent aux critères
        $subQb = $this->createQueryBuilder('e')
            ->select('e.id')
            ->where('e.actif = true');

        if ($localisation) {
            $subQb->andWhere('e.localisation = :loc')
                ->setParameter('loc', $localisation);
        }

        if ($categorie) {
            $subQb->andWhere('e.categorie = :cat')
                ->setParameter('cat', $categorie);
        }

        if ($prix) {
            $subQb->andWhere('ABS(e.prixParPersonne) <= :prix')
                ->setParameter('prix', $prix);
        }

        if ($duree) {
            $subQb->andWhere('e.duree = :duree')
                ->setParameter('duree', $duree);
        }

        if ($langue) {
            $subQb->andWhere('e.guide = :langue')
                ->setParameter('langue', $langue);
        }

        if ($maxPers) {
            $subQb->andWhere('e.maxPers <= :maxPers')
                ->setParameter('maxPers', $maxPers);
        }

        // Si on a un filtre de note, on applique une sous-requête
        if ($rating) {
            $subQb->andWhere(
                $subQb->expr()->gte(
                    $this->createQueryBuilder('e2')
                        ->select('AVG(av2.note)')
                        ->leftJoin('e2.avis', 'av2')
                        ->where('e2.id = e.id')
                        ->getDQL(),
                    ':rating'
                )
            )->setParameter('rating', $rating);
        }

        // On applique la pagination sur la sous-requête
        if ($limit !== null) {
            $subQb->setMaxResults($limit);
        }

        if ($offset !== null) {
            $subQb->setFirstResult($offset);
        }

        $excursionIds = array_column($subQb->getQuery()->getScalarResult(), 'id');

        // Si aucun résultat, on retourne un tableau vide
        if (empty($excursionIds)) {
            return [];
        }

        // Ensuite, on récupère les excursions complètes avec toutes les relations
        $qb = $this->createQueryBuilder('e')
            ->leftJoin('e.images', 'img')
            ->addSelect('img')
            ->leftJoin('e.inclusList', 'inc')
            ->addSelect('inc')
            ->leftJoin('e.nonInclusList', 'ninc')
            ->addSelect('ninc')
            ->leftJoin('e.itineraires', 'it')
            ->addSelect('it')
            ->leftJoin('e.avis', 'av')
            ->addSelect('av')
            ->where('e.id IN (:ids)')
            ->setParameter('ids', $excursionIds)
            ->orderBy('e.createdAt', 'DESC');

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

    public function countByFilters(
        ?string $localisation,
        ?string $categorie,
        ?float $prix,
        ?string $duree,
        ?int $rating,
        ?string $langue,
        ?int $maxPers
    ): int {
        $qb = $this->createQueryBuilder('e')
            ->select('COUNT(DISTINCT e.id)')
            ->where('e.actif = true');

        if ($localisation) {
            $qb->andWhere('e.localisation = :loc')
            ->setParameter('loc', $localisation);
        }

        if ($categorie) {
            $qb->andWhere('e.categorie = :cat')
            ->setParameter('cat', $categorie);
        }

        if ($prix) {
            $qb->andWhere('ABS(e.prixParPersonne) <= :prix')
            ->setParameter('prix', $prix);
        }

        if ($duree) {
            $qb->andWhere('e.duree = :duree')
            ->setParameter('duree', $duree);
        }

        if ($langue) {
            $qb->andWhere('e.guide = :langue')
            ->setParameter('langue', $langue);
        }

        if ($maxPers) {
            $qb->andWhere('e.maxPers <= :maxPers')
            ->setParameter('maxPers', $maxPers);
        }

        if ($rating) {
            $qb->leftJoin('e.avis', 'av')
            ->groupBy('e.id')
            ->having('AVG(av.note) >= :rating')
            ->setParameter('rating', $rating);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}