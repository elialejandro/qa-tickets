<?php

namespace App\Enums\TestCase;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasColor, HasLabel
{
    case OPEN = 'open';
    case IN_COURSE = 'in_course';
    case CLOSED = 'closed';
    case REVIEW = 'review';
    case COMPLETED = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::IN_COURSE => 'In course',
            self::CLOSED => 'Closed',
            self::REVIEW => 'Review',
            self::COMPLETED => 'Completed',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN => 'gray',
            self::IN_COURSE => 'warning',
            self::CLOSED => 'danger',
            self::REVIEW => 'info',
            self::COMPLETED => 'success',
        };
    }
}
