<?php

namespace App\Repository;

use App\Entity\TicketAgenda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TicketAgenda|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketAgenda|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketAgenda[]    findAll()
 * @method TicketAgenda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketAgendaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketAgenda::class);
    }

    // /**
    //  * @return TicketAgenda[] Returns an array of TicketAgenda objects
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
    public function findOneBySomeField($value): ?TicketAgenda
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
