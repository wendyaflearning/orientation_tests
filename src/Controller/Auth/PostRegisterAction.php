<?php

namespace App\Controller\Auth;

use App\Application\Auth\UserRegistrationRequestDto;
use App\Domain\User\Service\UserRegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/register', name: 'register', methods: ['POST'])]
class PostRegisterAction extends AbstractController
{
    public function __construct(
        private readonly UserRegistrationService $registrationService,
    )
    {}

    /**
     */
    public function __invoke(
        #[MapRequestPayload] UserRegistrationRequestDto $userRegistrationDto
    ) : JsonResponse
    {
        $userResponseDto = $this->registrationService->register($userRegistrationDto);

        return $this->json(
            $userResponseDto,
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json'],
            ['groups' => ['public']]
        );
    }
}
