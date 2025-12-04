<?php
namespace App\Repository;

use App\Entity\ImageExcursion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageExcursion>
 */
class ImageExcursionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageExcursion::class);
    }

    // Ici tu peux ajouter des méthodes personnalisées si besoin
}
