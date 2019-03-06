<?php

namespace App\Repository;

use App\Entity\Copybook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Copybook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Copybook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Copybook[]    findAll()
 * @method Copybook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CopybookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Copybook::class);
    }

    // /**
    //  * @return Copybook[] Returns an array of Copybook objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Copybook
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
