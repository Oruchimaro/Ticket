<?php

namespace App\Filament\Admin\Resources\TicketResource\Widgets;

use App\Filament\Admin\CustomWidgets\MetricWidget;
use App\Models\Ticket;
use Illuminate\Contracts\Support\Htmlable;

class MetricsWidgetSample extends MetricWidget
{
    public ?string $filter = 'week';

    protected string|Htmlable $label = 'Tickets Overview';

    public function getValue()
    {
        return match ($this->filter) {
            'week' => Ticket::whereBetween('created_at', [now()->startOfWeek(), now()])->count(),
            'month' => Ticket::whereBetween('created_at', [now()->startOfMonth(), now()])->count(),
            'year' => Ticket::whereBetween('created_at', [now()->startOfYear(), now()])->count(),
            default => Ticket::whereBetween('created_at', [now()->startOfWeek(), now()])->count(),
        };
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'This Week',
            'month' => 'This Month',
            'year' => 'This Year',
        ];
    }
}
