<?php

namespace App\Application\Tests;

use App\Application\Question\QuestionsResponseDto;
use App\Entity\Tests;

class GetTestDetailsResponseDto
{
    public function __construct(
        public string $name,
        public string $description,
        public string $method,
        public array $questions,
    )
    {}

    public static function fromEntity(Tests $test): self
    {
        return new self(
            name: $test->getName(),
            description: $test->getDescription(),
            method: $test->getMethod()->getName(),
            questions: QuestionsResponseDto::fromArray($test->getQuestions()->toArray())
        );
    }
}
