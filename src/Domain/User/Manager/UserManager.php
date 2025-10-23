<?php

namespace App\Domain\User\Manager;


use App\Application\User\UserDetailsResponseDto;
use App\Domain\Common\Manager\EntityManager;
use App\Repository\UsersRepository;

class UserManager extends EntityManager
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
    )
    {

    }
    public function getDetails(int $userId): UserDetailsResponseDto
    {
        $user = $this->usersRepository->find($userId);
        return UserDetailsResponseDto::fromEntity($user);
    }
}
