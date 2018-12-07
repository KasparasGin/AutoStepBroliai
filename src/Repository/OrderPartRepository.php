<?php

namespace App\Repository;

use App\Entity\OrderPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OrderPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPart[]    findAll()
 * @method OrderPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPartRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OrderPart::class);
    }

    // /**
    //  * @return OrderPart[] Returns an array of OrderPart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderPart
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
