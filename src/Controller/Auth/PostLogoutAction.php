<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/logout', name: 'api_logout', methods: ['POST'])]
class PostLogoutAction extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return $this->json(
            ['message' => 'Success logout'],
            Response::HTTP_OK,
        );
    }
}
