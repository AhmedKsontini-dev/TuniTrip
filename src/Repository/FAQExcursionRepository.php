<?php
namespace App\Repository;

use App\Entity\FAQExcursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FAQExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FAQExcursion::class);
    }

    // Méthodes personnalisées si nécessaire
}
