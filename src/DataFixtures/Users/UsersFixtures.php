<?php

namespace App\DataFixtures\Users;

use App\Entity\Users;
use App\Enums\Users\UsersStatusEnum;
use Faker\Factory as FakerFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public const RANDOM_USER = 'random_user';

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        $plainPassword = 'password123';

        for ($i = 0; $i < 10; $i++) {
            $user = new Users();
            $user->setName($faker->name());
            $user->setEmail($faker->email());
            $user->setAge($faker->numberBetween(18, 65));
            $user->setStatus($faker->randomElement(UsersStatusEnum::cases()));
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdatedAt(new \DateTimeImmutable());

            $password = $this->passwordHasher->hashPassword($user, $plainPassword);

            $user->setPassword($password);

            $this->addReference(self::RANDOM_USER . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
