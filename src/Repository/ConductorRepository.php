<?php

namespace App\Repository;

use App\Entity\Conductor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conductor>
 *
 * @method Conductor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conductor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conductor[]    findAll()
 * @method Conductor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConductorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conductor::class);
    }

//    /**
//     * @return Conductor[] Returns an array of Conductor objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Conductor
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
