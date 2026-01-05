<?php

namespace App\Enums\TestCase;

use Filament\Support\Contracts\HasColor;

enum Priority: string implements HasColor
{
    case LOW = 'normal';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::LOW => 'success',
            self::MEDIUM => 'warning',
            self::HIGH => 'danger',
        };
    }
}
