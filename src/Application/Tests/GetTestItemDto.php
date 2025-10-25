<?php

namespace App\Application\Tests;

use App\Entity\Tests;

readonly class GetTestItemDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public array $method
    ) {}

    public static function fromEntity(Tests $tests): GetTestItemDto
    {
        return new self(
            id: $tests->getId(),
            name: $tests->getName(),
            description: $tests->getDescription(),
            method: $tests->getMethod() ? [
                'name' => $tests->getMethod()->getName(),
            ] : null
        );
    }
}
