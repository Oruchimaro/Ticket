<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TicketStatusEnum: string implements HasColor, HasLabel
{
    case OPEN = 'Opens';
    case CLOSED = 'Closed';
    case ARCHIVED = 'Archived';

    public function getLabel(): ?string
    {
        return $this->value;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::OPEN => 'warning',
            self::CLOSED => 'success',
            self::ARCHIVED => 'gray',
        };
    }
}
