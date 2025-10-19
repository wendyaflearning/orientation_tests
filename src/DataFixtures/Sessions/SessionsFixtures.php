<?php

namespace App\DataFixtures\Sessions;

use App\DataFixtures\Tests\TestsFixtures;
use App\DataFixtures\Users\UsersFixtures;
use App\Entity\Sessions;
use App\Entity\Tests;
use App\Entity\Users;
use App\Enums\Sessions\SessionsStatusEnum;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class SessionsFixtures extends Fixture implements DependentFixtureInterface
{
    public const SESSION_STATUS = [SessionsStatusEnum::IN_PROGRESS, SessionsStatusEnum::COMPLETED, SessionsStatusEnum::ABANDONED, SessionsStatusEnum::CANCELLED];

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_Fr');

        $users = $manager->getRepository(Users::class)->findAll();
        $test = $manager->getRepository(Tests::class)->findOneBy(['name' => TestsFixtures::TEST_RIASEC]);

        for($i = 0; $i < 5; $i++) {

            $session = ((new Sessions))
            ->setCandidate($faker->randomElement($users))
            ->setTest($test)
            ->setStatus($faker->randomElement(self::SESSION_STATUS))
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable());
            
            $manager->persist($session);
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class, 
            TestsFixtures::class
        ];
    }
}
