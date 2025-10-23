<?php

namespace App\Application\User;

use App\Entity\Users;
use App\Enums\Users\UsersStatusEnum;
use Symfony\Component\Serializer\Attribute\Groups;

readonly class UserDetailsResponseDto
{
    public function __construct(
        #[Groups('public')]
        public int $id,

        #[Groups('public')]
        public string $name,

        #[Groups('public')]
        public string $email,

        #[Groups('public')]
        public UsersStatusEnum $status,

        #[Groups('public')]
        public array $roles
    )
    {}

    public static function fromEntity(Users $user): self
    {
        return new self(
            id : $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            status: $user->getStatus(),
            roles: $user->getRoles()
        );
    }
}
