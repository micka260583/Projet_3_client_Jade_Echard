<?php

namespace App\Repository;

use App\Entity\AboutInfoCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AboutInfoCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutInfoCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutInfoCategory[]    findAll()
 * @method AboutInfoCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutInfoCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AboutInfoCategory::class);
    }

    // /**
    //  * @return AboutInfoCategory[] Returns an array of AboutInfoCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AboutInfoCategory
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
