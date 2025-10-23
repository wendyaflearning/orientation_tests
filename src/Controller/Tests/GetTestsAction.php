<?php

namespace App\Controller\Tests;

use App\Application\Tests\GetTestsDto;
use App\Domain\Tests\Manager\TestManager;
use App\Entity\Tests;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetTestsAction extends AbstractController
{
    public function __construct(
        private readonly TestManager $testManager
    )
    {}

    #[Route(path: '/api/tests', name: 'api_tests', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $tests = $this->testManager->findAll(Tests::class);

        return $this->json(
            GetTestsDto::fromArray($tests),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
