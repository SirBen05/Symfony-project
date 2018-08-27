<?php

namespace App\Repository;

use App\Entity\Bass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bass|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bass|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bass[]    findAll()
 * @method Bass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bass::class);
    }

//    /**
//     * @return Bass[] Returns an array of Bass objects
//     */
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
    public function findOneBySomeField($value): ?Bass
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
