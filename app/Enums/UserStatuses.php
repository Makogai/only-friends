<?php

namespace App\Enums;

enum UserStatuses: string
{
    // backed enums
    case ACTIVE = 'active';
    case DND = 'do not disturb';
    case ON_VACATION = 'on vacation';
    case CHILLING = 'chilling';

}
