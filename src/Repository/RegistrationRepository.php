<?php

namespace App\Repository;

use App\Entity\Registration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Registration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registration[]    findAll()
 * @method Registration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registration::class);
    }

//    /**
//    * @return Registration[] Returns an array of Registration objects
//    */
//    public function findBySearch($value, $value2, $value3)
//    {
//        return $this->createQueryBuilder('r')
//            ->orWhere('r.member.firstName LIKE :val')
//            ->orWhere('r.member.prePosition LIKE :val2')
//            ->orWhere('r.member.lastName = :val3')
//            ->setParameter('val', '%'.$value.'%')
//            ->setParameter('val2', '%'.$value2.'%')
//            ->setParameter('val3', '%'.$value3.'%')
//            ->orderBy('r.id', 'ASC')
//            ->getQuery()
//            ->getResult()
//        ;
//    }


    /*
    public function findOneBySomeField($value): ?Registration
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
