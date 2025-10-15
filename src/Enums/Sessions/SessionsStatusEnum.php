<?php

namespace App\Enums\Sessions;

enum SessionsStatusEnum: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ABANDONED = 'abandoned';
    case CANCELLED = 'cancelled';
}