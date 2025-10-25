<?php

namespace App\Application\Answer;

use App\Entity\Answers;

readonly class AnswerItemDto
{
    public function __construct(
        public string $content,
        public string $methodDimensionName,
        public int $methodDimensionValue,
    ) {}
    public static function fromEntity(Answers $answer): self
    {
        return new self(
            content: $answer->getContent(),
            methodDimensionName:  $answer->getMethodDimension()->getName(),
            methodDimensionValue:  $answer->getMethodDimensionValue()
        );
    }
}
