<?php

namespace App\Domain\Tests\Manager;



use App\Entity\Tests;
use App\Repository\TestsRepository;

readonly class TestManager
{
    public function __construct(
        private TestsRepository $testsRepository,
    )
    {}

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
