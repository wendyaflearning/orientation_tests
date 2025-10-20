<?php

namespace App\DataFixtures\Feedbacks;

use App\DataFixtures\Scores\ScoresFixtures;
use App\DataFixtures\Sessions\SessionsFixtures;
use App\Entity\Feedbacks;
use App\Entity\Sessions;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeedbacksFixtures extends Fixture implements DependentFixtureInterface
{
    public const LLM_MODEL = 'gpt-4o-mini';
    public const TOKENS_CONSUMED = 100;
    

    public function load(ObjectManager $manager): void
    {
        $sessions = $manager->getRepository(Sessions::class)->findAll();

        foreach($sessions as $session) {
            $scores = $session->getScoresAsJson();
            $candidate = $session->getCandidate();

            if(empty($scores)) {
                continue;
            }
            $feedback = FeedbackTemplates::getFeedbackForDominantDimension($scores);
            $feedback = (new Feedbacks())
                ->setSession($session)
                ->setCandidate($candidate)
                ->setLlmModel(self::LLM_MODEL)
                ->setTokensConsumed(self::TOKENS_CONSUMED)
                ->setGeneratedAt(new DateTimeImmutable())
                ->setStructuredData([
                    'profile' => $feedback['title'],
                    'recommendations' => $feedback['recommendations'],
                ])
                ->setContent($feedback['content'])
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($feedback);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SessionsFixtures::class,
            ScoresFixtures::class,
        ];
    }
}
