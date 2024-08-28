<?php

namespace App\Livewire;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Role;
use App\Models\Ticket;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;

class ListTickets extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $model = Ticket::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(Ticket::query())
            ->defaultSort('created_at', 'desc')
            // ->modifyQueryUsing(
            //     fn (Builder $query) => auth()->user()->hasRole(Role::ROLES['Admin'])
            //     ? $query
            //     : $query->where('assigned_to', auth()->id())
            // )
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
                    ->toggleable(),
                // ->disabled(! auth()->user()->hasPermission('ticket_edit')), // add editable input in table row
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
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-s-pencil')
                    ->url(fn (Ticket $ticket) => route('tickets.edit', $ticket)),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.list-tickets');
    }
}
