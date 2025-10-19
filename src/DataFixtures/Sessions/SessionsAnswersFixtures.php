<?php

namespace App\DataFixtures\Sessions;

use App\DataFixtures\Answers\AnswersFixtures;
use App\DataFixtures\Tests\TestsFixtures;
use App\Entity\Questions;
use App\Entity\Sessions;
use App\Entity\SessionsAnswers;
use App\Entity\Tests;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use \Faker\Factory as FakerFactory;

class SessionsAnswersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');
        $test = $manager->getRepository(Tests::class)->findOneBy(['name' => TestsFixtures::TEST_RIASEC]);

        $sessions = $manager->getRepository(Sessions::class)->findAll();
        $questions = $manager->getRepository(Questions::class)->findBy(['test' => $test],['order_index' => 'ASC']);

        // Pour chaque session, créer des réponses pour toutes les questions
        foreach($sessions as $session) {
            foreach($questions as $question) {
                $answers = $question->getAnswers();

                if(count($answers) === 0) {
                    continue;
                }

                $sessionAnswers = ((new SessionsAnswers))
                                    ->setSession($session)
                                    ->setAnswer($faker->randomElement($answers))
                                    ->setCreatedAt(new DateTimeImmutable())
                                    ->setUpdatedAt(new DateTimeImmutable());

                $manager->persist($sessionAnswers);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SessionsFixtures::class, 
            AnswersFixtures::class
        ];
    }
}
