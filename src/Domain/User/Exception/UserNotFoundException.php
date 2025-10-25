<?php

namespace App\Domain\User\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    public function __construct(int $userId)
    {
        parent::__construct(sprintf('User with id %s not found', $userId,));
    }
}
