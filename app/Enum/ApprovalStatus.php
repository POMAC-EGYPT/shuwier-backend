<?php

namespace App\Enum;

enum ApprovalStatus: string
{
    case REQUESTED = 'requested';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
