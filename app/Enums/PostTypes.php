<?php

namespace App\Enums;

enum PostTypes: string
{
    // backed enums
    case IMAGE = 'image';
    case VIDEO = 'video';
    case TEXT = 'text';
    case SHARE = 'share';

}
