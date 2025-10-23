<?php

namespace App\Controller\User;

use App\Domain\User\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/users/{userId}', name: 'get_user_details', methods: ['GET'])]
class GetUserDetailsAction extends AbstractController
{
    public function __construct(
        private readonly UserManager $userManager
    ) {}

    public function __invoke(int $userId): JsonResponse
    {
        $userResponseDto = $this->userManager->getDetails($userId);
        return $this->json(
            $userResponseDto,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json'],
            ['groups' => ['public']]
        );
    }

}
