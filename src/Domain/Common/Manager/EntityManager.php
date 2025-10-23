<?php

namespace App\Domain\Common\Manager;

use Doctrine\ORM\EntityManagerInterface;

class EntityManager
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {}
    public function save($entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function findAll($class): array
    {
        return $this->entityManager->getRepository($class)->findAll();
    }
}
