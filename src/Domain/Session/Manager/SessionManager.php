<?php

namespace App\Domain\Session\Manager;

use App\Entity\Sessions;
use App\Entity\Tests;
use App\Entity\Users;
use App\Repository\SessionsRepository;

readonly class SessionManager
{
    public function __construct(
        private SessionsRepository $sessionsRepository,
    ) {}

    public function findByUserAndTest(Users $user, Tests $test): ?Sessions
    {
        return $this->sessionsRepository->findOneBy([
            'candidate' => $user,
            'test' => $test
        ]);
    }
}
