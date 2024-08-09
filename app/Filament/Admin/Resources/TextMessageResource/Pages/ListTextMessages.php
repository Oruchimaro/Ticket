<?php

namespace App\Filament\Admin\Resources\TextMessageResource\Pages;

use App\Filament\Admin\Resources\TextMessageResource;
use Filament\Resources\Pages\ListRecords;

class ListTextMessages extends ListRecords
{
    protected static string $resource = TextMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
