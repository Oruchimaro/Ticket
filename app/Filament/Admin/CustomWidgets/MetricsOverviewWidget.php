<?php

namespace App\Filament\Admin\CustomWidgets;

use Filament\Widgets\Concerns\CanPoll;
use Filament\Widgets\Widget;

class MetricsOverviewWidget extends Widget
{
    use CanPoll;

    protected static string $view = 'filament.admin.custom-widgets.metrics-overview-widget';

    /**
     * @var array<MetricWidget> | null
     */
    protected ?array $cachedMetrics = null;

    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        $count = count($this->getCachedMetrics());

        if ($count < 3) {
            return 3;
        }

        if (($count % 3) !== 1) {
            return 3;
        }

        return 4;
    }

    /**
     * @return array<MetricWidget>
     */
    protected function getCachedMetrics(): array
    {
        return $this->cachedMetrics ??= $this->getMetrics();
    }

    /**
     * instead of getStats from Stat, we will return getMetrics method,
     *
     * @return array<MetricWidget>
     */
    protected function getMetrics(): array
    {
        return [];
    }
}
