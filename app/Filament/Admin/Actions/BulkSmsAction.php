<?php

namespace App\Filament\Admin\Actions;

use App\Services\TextMessageService;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class BulkSmsAction
{
    public static function make(): BulkAction
    {
        return BulkAction::make('sendBulkSms')
            ->modalSubmitActionLabel('send message')
            ->icon('heroicon-s-chat-bubble-left-ellipsis')
            ->deselectRecordsAfterCompletion()
            ->color(Color::Blue)
            ->form([
                Textarea::make('message')
                    ->placeholder('Enter Message Here...')
                    ->required()
                    ->rows(4),
                Textarea::make('remarks'),
            ])
            ->action(function (array $data, Collection $collection) {
                TextMessageService::sendMessage($data, $collection);

                Notification::make()
                    ->title('Message Sent Successfully')
                    ->success()
                    ->send();
            });
    }
}
