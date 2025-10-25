<?php

namespace App\Application\Question;

use App\Application\Answer\AnswersResponseDto;
use App\Entity\Questions;

readonly class QuestionItemDto
{
    public function __construct(
        public string $name,
        public string $order_index,
        public array $answers,
    ) {}

    public static function fromEntity(Questions $question): self
    {
        return new self(
            name: $question->getName(),
            order_index: $question->getOrderIndex(),
            answers: AnswersResponseDto::fromArray($question->getAnswers()->toArray())
        );
    }
}
