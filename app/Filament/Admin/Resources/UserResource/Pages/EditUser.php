<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updatePassword')
                ->form([
                    TextInput::make('password')->required()->password()->confirmed(),
                    TextInput::make('password_confirmation')->required()->password(),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'password' => $data['password'], // is hashed in casts
                    ]);

                    Notification::make()
                        ->title(__('Message Updated Successfully.'))
                        ->success()
                        ->send();
                }),
        ];
    }
}
