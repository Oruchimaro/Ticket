<?php

namespace App\Filament\Admin\Resources;

use App\Enums\TextMessageStatusEnum;
use App\Filament\Admin\Resources\TextMessageResource\Pages;
use App\Models\TextMessage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TextMessageResource extends Resource
{
    protected static ?string $model = TextMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('sentTo.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sentBy.name')
                    ->default('-')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('message')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('remarks')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:m:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(TextMessageStatusEnum::class),
            ])
            ->actions([])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTextMessages::route('/'),
        ];
    }
}
