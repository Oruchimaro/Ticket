<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\CustomWidgets\MetricsOverviewWidget;
use App\Filament\Admin\CustomWidgets\MetricsWidgetSample;
use App\Filament\Admin\CustomWidgets\MetricsWidgetSample2;

class MetricsOverviewSample extends MetricsOverviewWidget
{
    protected function getMetrics(): array
    {
        return [
            MetricsWidgetSample::class,
            MetricsWidgetSample2::class,
        ];
    }
}
