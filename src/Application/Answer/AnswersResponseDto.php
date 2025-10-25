<?php

namespace App\Application\Answer;

readonly class AnswersResponseDto
{
    public function __construct(
        public array $answers
    ) {}

    /**
     * @param array $answers
     * @return array|AnswerItemDto[]
     */
    public static function fromArray(array $answers): array
    {
       return array_map(function($answer) {
            return AnswerItemDto::fromEntity($answer);
        }, $answers);
    }
}
