<?php

namespace App\Repository;

use App\Entity\ContactMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContactMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactMessage::class);
    }

    public function countUnread(): int
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->andWhere('c.lus = false')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findLastUnread(int $limit = 5): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.lus = false')
            ->orderBy('c.dateEnvoi', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

}
