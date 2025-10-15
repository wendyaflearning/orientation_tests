<?php

namespace App\Enums\Users;

enum UsersStatusEnum: string
{
    case STUDENT = 'student';
    case JOB_SEEKER = 'job_seeker';
    case ADMIN = 'admin';
    case EMPLOYEE = 'employee';
}
