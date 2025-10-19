<?php

namespace App\DataFixtures\Methods;

use App\Entity\Method;
use App\Entity\MethodDimension;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MethodDimensionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dimensions = [
            ['code' => 'R', 'name' => 'Realiste'],
            ['code' => 'I', 'name' => 'Investigateur'],
            ['code' => 'A', 'name' => 'Artistique'],
            ['code' => 'S', 'name' => 'Social'],
            ['code' => 'E', 'name' => 'Entreprenant'],
            ['code' => 'C', 'name' => 'Conventionnel'],
        ];

        foreach ($dimensions as $dimension) {
            $methodDimension = new MethodDimension();
            $methodDimension->setName($dimension['name']);
            $methodDimension->setCode($dimension['code']);
            /** @var Method $method */
            $method = $this->getReference(MethodsFixtures::METHOD_RIASEC, Method::class);
            $methodDimension->setMethod($method);
            
            $methodDimension->setCreatedAt(new \DateTimeImmutable());
            $methodDimension->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($methodDimension);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MethodsFixtures::class
        ];
    }
}
