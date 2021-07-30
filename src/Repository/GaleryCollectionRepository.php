<?php

namespace App\Repository;

use App\Entity\GaleryCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GaleryCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method GaleryCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method GaleryCollection[]    findAll()
 * @method GaleryCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GaleryCollectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GaleryCollection::class);
    }

    // /**
    //  * @return GaleryCollection[] Returns an array of GaleryCollection objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GaleryCollection
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
