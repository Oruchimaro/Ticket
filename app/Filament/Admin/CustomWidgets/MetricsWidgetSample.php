<?php

namespace App\Filament\Admin\CustomWidgets;

use Illuminate\Contracts\Support\Htmlable;

class MetricsWidgetSample extends MetricWidget
{
    protected string|Htmlable $label = 'new label';

    protected $value = 1;

    protected function getMetrics(): array
    {
        return [];
    }
}
