<?php

namespace App\DataFixtures\Questions;

use App\DataFixtures\Tests\TestsFixtures;
use App\Entity\Questions;
use App\Entity\Tests;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $questions = [
            ['name' => 'Face à un casse-tête ou un problème complexe, tu préfères..' , 'order_index' => 1], 
            ['name' => 'Quand tu apprends quelque chose de nouveau (logiciel, instrument, sport)...' , 'order_index' => 2], 
            ['name' => 'Pour organiser un grand projet avec beaucoup d\'infos, tu...' , 'order_index' => 3], 

        ];

        $test = $this->getReference(TestsFixtures::TEST_RIASEC, Tests::class);

        foreach($questions as $object) {
            $question = new Questions();
            $question->setName($object['name']);
            $question->setTest($test);
            $question->setOrderIndex($object['order_index']);
            $question->setCreatedAt(new DateTimeImmutable());
            $question->setUpdatedAt(new DateTimeImmutable());

            $manager->persist($question);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TestsFixtures::class
        ];
    }
}
