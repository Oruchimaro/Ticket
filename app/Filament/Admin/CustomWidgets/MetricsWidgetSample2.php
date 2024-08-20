<?php

namespace App\Filament\Admin\CustomWidgets;

use Illuminate\Contracts\Support\Htmlable;

class MetricsWidgetSample2 extends MetricWidget
{
    protected string|Htmlable $label = 'sample two';

    protected $value = 'value 2';

    protected function getMetrics(): array
    {
        return [];
    }
}
