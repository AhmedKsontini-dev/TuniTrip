<?php

namespace App\Repository;

use App\Entity\ReservationTransfert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationTransfert>
 */
class ReservationTransfertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationTransfert::class);
    }

    /**
     * 🔹 Trouver les réservations selon un statut
     *
     * @param string $statut
     * @return ReservationTransfert[]
     */
    public function findByStatut(string $statut): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.statut = :statut')
            ->setParameter('statut', $statut)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * 🔹 Compter le nombre de réservations par mois (pour statistiques)
     *
     * @return array Exemple :
     * [
     *   ['month' => '2025-01', 'count' => 12],
     *   ['month' => '2025-02', 'count' => 8],
     * ]
     */
    public function countByMonth(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(id) AS count
            FROM reservation_transfert
            GROUP BY month
            ORDER BY month ASC
        ";

        return $conn->executeQuery($sql)->fetchAllAssociative();
    }

    /**
     * 🔹 Récupérer les X dernières réservations (par défaut 5)
     *
     * @param int $limit
     * @return ReservationTransfert[]
     */
    public function findRecent(int $limit = 5): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
