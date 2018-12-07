<?php

namespace App\Repository;

use App\Entity\BrokenPartDescription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BrokenPartDescription|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrokenPartDescription|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrokenPartDescription[]    findAll()
 * @method BrokenPartDescription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrokenPartDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BrokenPartDescription::class);
    }

    // /**
    //  * @return BrokenPartDescription[] Returns an array of BrokenPartDescription objects
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
    public function findOneBySomeField($value): ?BrokenPartDescription
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
