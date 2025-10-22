<?php

namespace App\Application\Auth;

use App\Enums\Users\UsersStatusEnum;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationRequestDto
{
    #[Assert\NotBlank(
        message: 'Le champ {{ property }} est obligatoire',
    )]
    public string $name;

    #[Assert\Email(
        message: 'Votre email {{ value }} est invalida',
    )]
    public string $email;

    #[Assert\Positive]
    public int $age;

    #[Assert\Length(min: 5, max: 8)]
    public string $password;

    public UsersStatusEnum $status;

    public string $roles;
}
