<?php

namespace App\Enum;

enum SearchType: string
{
    case SERVICE = 'service';
    case PROJECT = 'project';
    case USER = 'user';
    case POST = 'post';
}
