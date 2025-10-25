<?php

namespace App\Domain\User\Manager;


use App\Application\User\UserDetailsResponseDto;
use App\Domain\User\Exception\UserNotFoundException;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

readonly class UserManager
{
    public function __construct(
        private UsersRepository $usersRepository,
        private EntityManager $entityManager,
    ){}
    public function getDetails(int $userId): UserDetailsResponseDto
    {
        $user = $this->usersRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException($userId);
        }

        return UserDetailsResponseDto::fromEntity($user);
    }

    public function findByEmail(string $email): Users
    {
        return $this->usersRepository->findOneBy(['email' => $email]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(Users $users): void
    {
        $this->entityManager->persist($users);
        $this->entityManager->flush();
    }
}
