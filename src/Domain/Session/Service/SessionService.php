<?php

namespace App\Domain\Session\Service;

use App\Entity\Sessions;
use App\Entity\Tests;
use App\Entity\Users;
use App\Enums\Sessions\SessionsStatusEnum;
use Doctrine\ORM\EntityManagerInterface;

readonly class SessionService
{
    public function __construct(
        public EntityManagerInterface $entityManager,
    )
    {}
    public function create(Users $users, Tests $tests): Sessions
    {
        return ((new Sessions())
                        ->setStatus(SessionsStatusEnum::IN_PROGRESS)
                        ->setCandidate($users)
                        ->setTest($tests)
        );
    }

}
