<?php

namespace App\Application\Tests;

readonly class GetTestsDto
{
    /**
     * @param array<GetTestItemDto> $testsDto
     */
    public function __construct(
        public array $testsDto
    ) {}

    public static function fromArray(array $testsEntities): GetTestsDto
    {
        $testsDto = [];

        foreach ($testsEntities as $testEntity) {
            $testsDto[] = GetTestItemDto::fromEntity($testEntity);
        }

        return new self($testsDto);
    }
}
