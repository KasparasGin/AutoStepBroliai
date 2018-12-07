<?php

namespace App\Repository;

use App\Entity\ToolReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ToolReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ToolReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ToolReservation[]    findAll()
 * @method ToolReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToolReservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ToolReservation::class);
    }

    // /**
    //  * @return ToolReservation[] Returns an array of ToolReservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ToolReservation
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
