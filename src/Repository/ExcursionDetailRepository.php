<?php
namespace App\Repository;

use App\Entity\ExcursionDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExcursionDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExcursionDetail::class);
    }

    // Ajoute ici tes méthodes personnalisées si nécessaire
}
