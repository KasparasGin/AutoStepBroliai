<?php

namespace App\Repository;

use App\Entity\Waybill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Waybill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Waybill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Waybill[]    findAll()
 * @method Waybill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaybillRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Waybill::class);
    }

    // /**
    //  * @return Waybill[] Returns an array of Waybill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Waybill
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
