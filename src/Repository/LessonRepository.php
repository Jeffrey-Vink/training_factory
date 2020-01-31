<?php

namespace App\Repository;

use App\Entity\Lesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    /**
     * @return Lesson[] Returns an array of Lesson objects
     */
    public function findByDate()
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.dateTime BETWEEN :vandaag AND :week')
            ->setParameter('vandaag', date('now'))
            ->setParameter('week', date("Y-m-d", strtotime("+1 week")))
            ->orderBy('l.dateTime', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllByDate()
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.dateTime > CURRENT_DATE()-365')
            ->orderBy('l.dateTime', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Lesson
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
