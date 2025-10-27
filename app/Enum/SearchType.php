<?php

namespace App\Enum;

enum SearchType: string
{
    case SERVICE = 'service';
    case PROJECT = 'project';
    case CLIENT = 'client';
    case FREELANCER = 'freelancer';
    case POST = 'post';
}
