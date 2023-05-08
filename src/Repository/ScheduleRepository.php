<?php

namespace App\Repository;

use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Schedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schedule[]    findAll()
 * @method Schedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    public function findByAvailable($sDate)
    {
        return $this->createQueryBuilder('s')
            ->Where("s.BookAvail = 'disponible' ")
            ->andWhere('s.ScheduleDate = :val')
            ->setParameter('val', $sDate)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    public function updateDisponibilite($i,$status,$numeroidSchedule, $disponible,$nondisponible)
    {
        $query = $this->createQueryBuilder('')
           ->update(Schedule::class, 's');

        if ($status == "true") {
            $query = $query
               ->set('s.BookAvail', '?1')
                ->setParameter(1, 'disponible')    ;
        }
        else{
            $query = $query
                ->set('s.BookAvail', '?2')
                ->setParameter(2, 'nondisponible') ;
        }

        $query
         ->andWhere('s.id =:id')
        ->setParameter('id', $numeroidSchedule);

        $query =$query->getQuery();
        return $query->execute();
    }


}
