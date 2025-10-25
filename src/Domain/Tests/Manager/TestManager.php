<?php

namespace App\Domain\Tests\Manager;



use App\Entity\Tests;
use App\Repository\TestsRepository;

readonly class TestManager
{
    public function __construct(
        private TestsRepository $testsRepository,
    ) {}

    /**
     * @param int $id
     * @return Tests|null
     */
    public function find(int $id): ?Tests
    {
        return $this->testsRepository->find($id);
    }

    /**
     * @param int $id
     * @return Tests|null
     */
    public function findWithQuestions(int $testId): ?Tests
    {
        return $this->testsRepository->createQueryBuilder('t')
            ->leftJoin('t.questions', 'q')
            ->addSelect('q')
            ->where('t.id = :id')
            ->setParameter('id', $testId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return Tests[]
     */
    public function findAll(): array
    {
        $tests = $this->testsRepository->findAll();

        if (!$tests) {
            return [];
        }

        return $tests;
    }
}
