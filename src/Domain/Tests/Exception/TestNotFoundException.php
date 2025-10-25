<?php

namespace App\Domain\Tests\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestNotFoundException extends NotFoundHttpException
{
    public function __construct(int $testId)
    {
        parent::__construct(sprintf('Test with id %s not found', $testId));
    }
}
