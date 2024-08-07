<?php

namespace App\Filament\Admin\Resources;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Filament\Admin\Resources\TicketResource\Pages;
use App\Filament\Admin\Resources\TicketResource\RelationManagers\CategoriesRelationManager;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                Section::make('Select')
                    ->columns(2)
                    ->schema([
                        Radio::make('status')
                            ->required()
                            ->options(TicketStatusEnum::class)
                            ->in([
                                TicketStatusEnum::OPEN,
                                TicketStatusEnum::CLOSED,
                                TicketStatusEnum::ARCHIVED,
                            ]), // validate value be in the enum
                        Radio::make('priority')
                            ->required()
                            ->options(TicketPriorityEnum::class)
                            ->in([
                                TicketPriorityEnum::LOW,
                                TicketPriorityEnum::MEDIUM,
                                TicketPriorityEnum::HIGH,
                            ]), // validate value be in the enum
                        Select::make('assigned_to')
                            ->options(
                                User::whereHas(
                                    'roles',
                                    fn (Builder $query) => $query->where('name', Role::ROLES['Agent']))->pluck('name', 'id')->toArray()
                            )
                            ->searchable()
                            ->preload()
                            ->optionsLimit(10)
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Textarea::make('comment')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(
                fn (Builder $query) => auth()->user()->hasRole(Role::ROLES['Admin'])
                ? $query
                : $query->where('assigned_to', auth()->id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->description(
                        fn (Ticket $record): ?string => Str::limit($record?->description, Ticket::EXCERPT_LENGTH)
                    )
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(TicketStatusEnum::class)
                    ->searchable(),
                Tables\Columns\TextColumn::make('priority')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedBy.name')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextInputColumn::make('comment')
                    ->toggleable()
                    ->disabled(! auth()->user()->hasPermission('ticket_edit')), // add editable input in table row
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(TicketStatusEnum::class)
                    ->placeholder(__('Filter By Status')),
                SelectFilter::make('priority')
                    ->options(TicketPriorityEnum::class)
                    ->placeholder(__('Filter By Priority')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
