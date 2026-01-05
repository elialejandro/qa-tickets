<?php

namespace App\Enums\TestCase;

enum Status: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case CLOSED = 'closed';
    case REVIEW = 'review';
    case COMPLETED = 'completed';
}
