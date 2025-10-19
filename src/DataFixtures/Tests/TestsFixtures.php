<?php

namespace App\DataFixtures\Tests;

use App\DataFixtures\Methods\MethodsFixtures;
use App\Entity\Method;
use App\Entity\Tests;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class TestsFixtures extends Fixture implements DependentFixtureInterface
{
    public const TEST_RIASEC = 'riasec';

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        $method = $this->getReference(MethodsFixtures::METHOD_RIASEC, Method::class);

        $test = (new Tests())
                ->setName(self::TEST_RIASEC)
                ->setDescription($faker->paragraph(2, false))
                ->setMethod($method)
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());

        $manager->persist($test);

        // Enregistre la référence pour pouvoir l'utiliser dans d'autres fixtures
        $this->addReference(self::TEST_RIASEC, $test);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MethodsFixtures::class
        ];
    }
}
