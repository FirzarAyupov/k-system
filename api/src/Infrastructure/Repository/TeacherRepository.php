<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Teacher>
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teacher::class);
    }

    public function save(Teacher $teacher): void
    {
        $this->getEntityManager()->persist($teacher);
        $this->getEntityManager()->flush();
    }

    public function remove(Teacher $teacher): void
    {
        $this->getEntityManager()->remove($teacher);
        $this->getEntityManager()->flush();
    }
}
