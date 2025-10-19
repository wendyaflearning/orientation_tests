<?php

namespace App\DataFixtures\Answers;

use App\DataFixtures\Methods\MethodDimensionsFixtures;
use App\DataFixtures\Questions\QuestionsFixtures;
use App\DataFixtures\Tests\TestsFixtures;
use App\Entity\Answers;
use App\Entity\MethodDimension;
use App\Entity\Questions;
use App\Entity\Tests;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $test=  $this->getReference(TestsFixtures::TEST_RIASEC, Tests::class);

        $anwers = [
            1 => [
                [
                    'content' => 'Analyser chaque élément séparément pour comprendre la logique',
                    'dimension' => 'I',
                    'value' => 3,
                ], 
                [
                    'content' => 'Chercher des patterns ou des solutions créatives inhabituelles',
                    'dimension' => 'A',
                    'value' => 3,
                ], 
                [
                    'content' => 'Me rappeler de situations similaires et appliquer ce qui a marché',
                    'dimension' => 'R',
                    'value' => 3,
                ], 
            ],
            2 => [
                [
                    'content' => 'Je décompose en étapes logiques et je progresse méthodiquement',
                    'dimension' => 'R',
                    'value' => 3,
                ], 
                [
                    'content' => 'J\'expérimente librement et je trouve mes propres méthodes',
                    'dimension' => 'C',
                    'value' => 3,
                ], 
                [
                    'content' => 'Je mémorise les techniques et je les répète jusqu\'à maîtrise',
                    'dimension' => 'C',
                    'value' => 3,
                ], 
            ],
            3 => [
                [
                    'content' => 'Crées un système structuré (tableau, diagramme, checklist)',
                    'dimension' => 'R',
                    'value' => 3,
                ], 
                [
                    'content' => 'Utilises des mind maps, des métaphores ou des associations visuelles',
                    'dimension' => 'C',
                    'value' => 3,
                ], 
                [
                    'content' => 'Notes tout dans l\'ordre et te fies à ta capacité à retrouver l\'info',
                    'dimension' => 'C',
                    'value' => 3,
                ], 
            ]
        ];

        $questionsByIndex = [];
        $questions = $manager->getRepository(Questions::class)->findBy(['test' => $test], ['order_index' => 'ASC']);

        foreach($questions as $question) {
            $questionsByIndex[$question->getOrderIndex()] = $question;
        }

        $dimensionsByCode = [];
        foreach(['R', 'I', 'A', 'S', 'E', 'C'] as $code) {
            $dimensionsByCode[$code] = $manager->getRepository(MethodDimension::class)->findOneBy(['code' => $code]);
        }

        foreach($anwers as $orderIndex => $answer) {

            $question = $questionsByIndex[$orderIndex] ?? null;

            if(!isset($question)) {
                continue;
            }

            foreach($answer as $data) {
                $newAnswer = (new Answers())
                                ->setQuestion($question)
                                ->setContent($data['content'])
                                ->setMethodDimension($dimensionsByCode[$data['dimension']])
                                ->setMethodDimensionValue($data['value'])
                                ->setCreatedAt(new DateTimeImmutable())
                                ->setUpdatedAt(new DateTimeImmutable());

                $manager->persist($newAnswer);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            QuestionsFixtures::class, 
            MethodDimensionsFixtures::class
        ];
    }
}
