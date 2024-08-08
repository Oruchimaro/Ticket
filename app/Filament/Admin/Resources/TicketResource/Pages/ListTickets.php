<?php

namespace App\Filament\Admin\Resources\TicketResource\Pages;

use App\Filament\Admin\Resources\TicketResource;
use App\Filament\Admin\Widgets\StatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [StatsOverview::class];
    }
}
