<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TicketPriorityEnum: string implements HasColor, HasLabel
{
    case LOW = 'Low';
    case MEDIUM = 'Medium';
    case HIGH = 'High';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::LOW => 'success',
            self::MEDIUM => 'warning',
            self::HIGH => 'danger',
        };
    }
}
