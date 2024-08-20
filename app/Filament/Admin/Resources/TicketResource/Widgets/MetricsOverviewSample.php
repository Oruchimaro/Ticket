<?php

namespace App\Filament\Admin\Resources\TicketResource\Widgets;

use App\Filament\Admin\CustomWidgets\MetricsOverviewWidget;

class MetricsOverviewSample extends MetricsOverviewWidget
{
    protected function getMetrics(): array
    {
        return [
            MetricsWidgetSample::class,
        ];
    }
}
