<?php

namespace App\Enum;

enum ProjectStatus: string
{
    case ACTIVE = 'active';
    case INPROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
