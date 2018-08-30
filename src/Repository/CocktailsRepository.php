<?php

namespace App\Repository;

use App\Entity\Cocktails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cocktails|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cocktails|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cocktails[]    findAll()
 * @method Cocktails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CocktailsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cocktails::class);
    }

//    /**
//     * @return Cocktails[] Returns an array of Cocktails objects
//     */
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
    public function findOneBySomeField($value): ?Cocktails
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
