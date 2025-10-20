<?php

namespace App\DataFixtures\Scores;

use App\DataFixtures\Sessions\SessionsAnswersFixtures;
use App\Entity\MethodDimension;
use App\Entity\Scores;
use App\Entity\SessionsAnswers;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ScoresFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupérer toutes les réponses de sessions
        $sessionsAnswers = $manager->getRepository(SessionsAnswers::class)->findAll();
        
        // Grouper par session
        $sessionScores = [];
        
        foreach ($sessionsAnswers as $sessionAnswer) {
            $session = $sessionAnswer->getSession();
            $answer = $sessionAnswer->getAnswer();
            
            if (!$session || !$answer) {
                continue;
            }
            
            $methodDimension = $answer->getMethodDimension();
            $value = $answer->getMethodDimensionValue();
            
            if (!$methodDimension || $value === null) {
                continue;
            }
            
            $sessionId = $session->getId();
            $dimensionId = $methodDimension->getId();
            
            // Initialiser la structure si nécessaire
            if (!isset($sessionScores[$sessionId])) {
                $sessionScores[$sessionId] = [
                    'session' => $session,
                    'dimensions' => []
                ];
            }
            
            if (!isset($sessionScores[$sessionId]['dimensions'][$dimensionId])) {
                $sessionScores[$sessionId]['dimensions'][$dimensionId] = [
                    'dimension' => $methodDimension,
                    'total' => 0
                ];
            }
            
            // Additionner la valeur
            $sessionScores[$sessionId]['dimensions'][$dimensionId]['total'] += $value;
        }
        
        // Créer les entités Scores
        foreach ($sessionScores as $sessionData) {
            foreach ($sessionData['dimensions'] as $dimensionData) {
                $score = (new Scores())
                    ->setSession($sessionData['session'])
                    ->setMethodDimension($dimensionData['dimension'])
                    ->setValue($dimensionData['total'])
                    ->setCreatedAt(new DateTimeImmutable())
                    ->setUpdatedAt(new DateTimeImmutable());
                    
                $manager->persist($score);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SessionsAnswersFixtures::class,
        ];
    }
}
