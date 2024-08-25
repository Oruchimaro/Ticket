<?php

namespace App\Filament\Admin\Resources\TicketResource\Widgets;

use App\Filament\Admin\CustomWidgets\MetricWidget;
use App\Models\Ticket;
use Illuminate\Contracts\Support\Htmlable;

class MetricWidgetTest extends MetricWidget
{
    protected string|Htmlable $label = 'High Priority This Year';

    public function getValue()
    {
        return Ticket::whereBetween('created_at', [now()->startOfYear(), now()])
            ->high()
            ->count();
    }
}
