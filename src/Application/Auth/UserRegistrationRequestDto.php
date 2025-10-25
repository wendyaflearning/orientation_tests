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

    #[Assert\NotBlank(
        message: 'Le champ {{ property }} est obligatoire',
    )]
    #[Assert\Length(min: 8)]
//    #[Assert\Regex(
//        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/',
//        message: 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre'
//    )]
    public string $password;

    public UsersStatusEnum $status;

}
