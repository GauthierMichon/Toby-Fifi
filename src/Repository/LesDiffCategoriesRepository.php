<?php

namespace App\Repository;

use App\Entity\LesDiffCategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LesDiffCategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method LesDiffCategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method LesDiffCategories[]    findAll()
 * @method LesDiffCategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LesDiffCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LesDiffCategories::class);
    }

    // /**
    //  * @return LesDiffCategories[] Returns an array of LesDiffCategories objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LesDiffCategories
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
