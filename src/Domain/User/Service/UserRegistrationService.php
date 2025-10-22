<?php

namespace App\Domain\User\Service;

use App\Application\Auth\UserRegistrationRequestDto;
use App\Application\Auth\UserRegistrationResponseDto;
use App\Domain\User\Manager\UserManager;
use App\Entity\Users;
use App\Enums\Users\UsersStatusEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRegistrationService
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserManager $userManager
    ) {}
        public function register(UserRegistrationRequestDto $userRegistrationDto): UserRegistrationResponseDto
        {
            $user = ((new Users())
                        ->setName($userRegistrationDto->name)
                        ->setEmail($userRegistrationDto->email)
                        ->setAge($userRegistrationDto->age)
                        ->setStatus(UsersStatusEnum::STUDENT)
                        ->setRoles(['ROLE_USER'])
                        ->setCreatedAt(new \DateTimeImmutable())
                        ->setUpdatedAt(new \DateTimeImmutable())
            );

            $hashPassword = $this->passwordHasher->hashPassword($user, $userRegistrationDto->password);

            $user->setPassword($hashPassword);

            $this->userManager->save($user);

            return UserRegistrationResponseDto::fromEntity($user);
        }


}
