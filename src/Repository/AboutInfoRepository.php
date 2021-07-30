<?php

namespace App\Repository;

use App\Entity\AboutInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AboutInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method AboutInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method AboutInfo[]    findAll()
 * @method AboutInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AboutInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AboutInfo::class);
    }

    // /**
    //  * @return AboutInfo[] Returns an array of AboutInfo objects
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
    public function findOneBySomeField($value): ?AboutInfo
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
