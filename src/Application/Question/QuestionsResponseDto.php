<?php

namespace App\Application\Question;

readonly class QuestionsResponseDto
{
    public function __construct(
    ) {}

    /**
     * Converts an array of question entities into an array of QuestionItemDto instances.
     *
     * @param QuestionItemDto[]
     *
     * @return array An array of QuestionItemDto instances created from the given entities.
     */
    public static function fromArray(array $questionsEntities): array
    {
        return array_map(function($question) {
            return QuestionItemDto::fromEntity($question);
        }, $questionsEntities);
    }
}
