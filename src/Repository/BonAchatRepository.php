<?php

namespace App\Repository;

use App\Entity\BonAchat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BonAchat|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonAchat|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonAchat[]    findAll()
 * @method BonAchat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonAchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonAchat::class);
    }

    // /**
    //  * @return BonAchat[] Returns an array of BonAchat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BonAchat
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
