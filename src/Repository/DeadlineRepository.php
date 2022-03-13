<?php

namespace App\Repository;

use App\Entity\Deadline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deadline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deadline|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deadline[]    findAll()
 * @method Deadline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeadlineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deadline::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Deadline $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Deadline $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return DeadlineEntity[] Returns an array of DeadlineEntity objects
    //  */

    public function findAllUntilNextFriday()
    {
        $lastDay = new \DateTime('friday next week');

        return $this->createQueryBuilder('d')
            ->andWhere('d.due_date < :lastDay')
            ->andWhere('d.is_done = 0')
            ->setParameter('lastDay', $lastDay)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return DeadlineEntity[] Returns an array of DeadlineEntity objects
    //  */

    public function findAllDeadlines()
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.is_done = 0')
            ->getQuery()
            ->getResult();
    }
}
