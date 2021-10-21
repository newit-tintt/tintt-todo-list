<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry ;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * Get all tasks
     * @return Task[] Returns an array of Task objects
    */
    public function getAll(): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT t.id, t.description, t.status, t.ischecked
            FROM App\Entity\Task t
            WHERE t.deleteflag = 0
            ORDER BY t.id ASC'
        );

        return $query->getResult();
    }

    /**
     * Get detail of task
     * @return Task Returns a Task objects
    */
    public function getDetail(int $id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT t.id, t.description, t.status, t.ischecked
            FROM App\Entity\Task t
            WHERE t.id = :id AND t.deleteflag = 0'
        )->setParameter('id', $id);
        
        return $query->getResult();
    }

    /**
     * Update a task
     * @return void
    */
    public function update(int $id, string $description, int $status, int $deleteFlag)
    {
        $entityManager = $this->getEntityManager();
        $qb = $entityManager->createQueryBuilder()
            ->update('App\Entity\Task', 't')
            ->where('t.id = :id')
            ->setParameter('id', $id);

        if ($description !== '') {
            
            $qb->set('t.description', ':description')
            ->setParameter('description', $description);
        }

        if ($status < 2) {
            $qb->set('t.status', ':status')
            ->setParameter('status', $status);
        }

        if ($deleteFlag < 2) {
            echo 'deleteFlag : '.$deleteFlag;
            $qb->set('t.deleteflag', ':deleteflag')
            ->setParameter('deleteflag', $deleteFlag);
        }

        $query = $qb->getQuery();
        return $query->execute();
    }

    /**
     * Add new task
     * @return void
    */
    public function add(string $description)
    {
        $entityManager = $this->getEntityManager();
        $newTask = new Task();

        $newTask
            ->setDescription($description)
            ->setStatus(0)
            ->setIsChecked(false)
            ->setdeleteFlag(0);

        $entityManager->persist($newTask);
        $entityManager->flush();
    }

    /**
     * Delete a task
     * @return void
    */
    public function delete(int $id)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            ' UPDATE App\Entity\Task t
              SET t.deleteflag = 1
              WHERE t.id = :id
            '
        )->setParameter('id', $id);
        
        $query->execute();
    }
    
}