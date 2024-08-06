<?php

namespace App\Filament\Admin\Widgets;

use App\Enums\TicketStatusEnum;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Tickets', Ticket::count())
                ->descriptionIcon('heroicon-o-ticket', IconPosition::Before)
                ->description('Total Tickets Submitted')
                ->color('success'),
            Stat::make('Open Tickets', Ticket::where('status', TicketStatusEnum::OPEN)->count())
                ->descriptionIcon('heroicon-o-flag', IconPosition::Before)
                ->description('Tickets With Open Status')
                ->color(Color::Rose),
            Stat::make(
                'Agents',
                User::whereHas(
                    'roles',
                    fn ($query) => $query->where('name', Role::ROLES['Agent'])
                )->count()
            )->descriptionIcon('heroicon-o-user', IconPosition::Before)
                ->description('Total Agents Active')
                ->color(Color::Sky),

            Stat::make('Tickets This Week', Ticket::whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->getData())
                ->color('success'),
        ];
    }

    protected function getData(): array
    {
        $data = Trend::model(Ticket::class)
            ->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
            ->perDay()
            ->count();

        return $data->map(fn (TrendValue $value) => $value->aggregate)->toArray();
    }
}
