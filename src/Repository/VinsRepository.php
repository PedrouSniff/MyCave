<?php

namespace App\Repository;

use App\Entity\Vins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vins>
 */
class VinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vins::class);
    }

       /**
        * @return Vins[] Returns an array of Vins objects
        */

        public function findVinsByUser($user)
        {
            return $this->createQueryBuilder('v')
                ->innerJoin('v.cavesVins', 'cv')
                ->innerJoin('cv.caves', 'c')
                ->where('c.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getResult();
        }
 
    //    public function findOneBySomeField($value): ?Vins
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
