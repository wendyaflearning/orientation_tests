<?php

namespace App\DataFixtures\Methods;

use App\Entity\Method;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MethodsFixtures extends Fixture
{
    public const METHOD_RIASEC = 'riasec';

    public function load(ObjectManager $manager): void
    {
        $method = (new Method())
                    ->setName(self::METHOD_RIASEC)
                    ->setCreatedAt(new DateTimeImmutable())
                    ->setUpdatedAt(new DateTimeImmutable());
                    
        $this->addReference(self::METHOD_RIASEC, $method);


        $manager->persist($method);

        $manager->flush();
    }
}
