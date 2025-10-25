<?php

namespace App\Controller\Tests;

use App\Application\Tests\GetTestDetailsResponseDto;
use App\Domain\Session\Manager\SessionManager;
use App\Domain\Session\Service\SessionService;
use App\Domain\Tests\Exception\TestNotFoundException;
use App\Domain\Tests\Manager\TestManager;
use App\Domain\User\Exception\UserNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetTestStartAction extends AbstractController
{
    public function __construct(
        private readonly TestManager $testManager,
        private readonly Security $security,
        private readonly SessionManager $sessionManager,
        private readonly SessionService $sessionService,
        private readonly LoggerInterface $logger,
    )
    {}
    #[Route(path: '/api/tests/{id}/start', name: 'api_test_started', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $testId = $request->attributes->get('id');

        $user = $this->security->getUser();
        if (!$user) {
            throw new UserNotFoundException('User non authentifié');
        }

        $test = $this->testManager->findWithQuestions($testId);
        if (!$test) {
            throw new TestNotFoundException($testId);
        }

        $session = $this->sessionManager->findByUserAndTest($user, $test);

        if (!$session) {
            $this->sessionService->create($user, $test);
        }

        $this->logger->info('User ' . $user->getId() . ' started test ' . $test->getId());

        return $this->json(
            GetTestDetailsResponseDto::fromEntity($test),
            Response::HTTP_OK,
        );
    }

}
