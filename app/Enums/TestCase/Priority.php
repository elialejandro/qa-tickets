<?php

namespace App\Enums\TestCase;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Priority: string implements HasColor, HasLabel
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

    public function getLabel(): string
    {
        return match ($this) {
            self::LOW => 'Normal',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }
}
