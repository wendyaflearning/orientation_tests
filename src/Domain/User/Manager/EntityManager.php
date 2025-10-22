<?php

namespace App\Domain\User\Manager;

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
}
