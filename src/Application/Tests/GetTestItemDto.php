<?php

namespace App\Application\Tests;

use App\Entity\Tests;

class GetTestItemDto
{
    public function __construct(
        public string $name,
        public string $description,
        public array $method
    ) {}

    public static function fromEntity(Tests $tests): GetTestItemDto
    {
        return new self(
            name: $tests->getName(),
            description: $tests->getDescription(),
            method: $tests->getMethod() ? [
                'name' => $tests->getMethod()->getName(),
            ] : null
        );
    }
}
