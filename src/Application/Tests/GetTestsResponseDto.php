<?php

namespace App\Application\Tests;

readonly class GetTestsResponseDto
{
    /**
     * @param array<GetTestItemDto> $tests
     */
    public function __construct(
        public array $tests
    ) {}

    public static function fromArray(array $testsEntities): GetTestsResponseDto
    {
        $tests = [];

        foreach ($testsEntities as $testEntity) {
            $tests[] = GetTestItemDto::fromEntity($testEntity);
        }

        return new self($tests);
    }
}
