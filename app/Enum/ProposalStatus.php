<?php

namespace App\Enum;

enum ProposalStatus: string
{
    case SUBMITTED = 'submitted';
    case VIEWED = 'viewed';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}
