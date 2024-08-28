<?php

namespace App\Livewire;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateTickets extends Component implements HasForms
{
    use InteractsWithForms;

    protected static ?string $model = Ticket::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('attachment'),
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
            ])
            ->statePath('data');
    }

    public function create()
    {
        Ticket::create($this->form->getState() + [
            'assigned_by' => auth()->id(),
        ]);

        Notification::make()
            ->success()
            ->title('Created Successfully')
            ->send();

        return redirect()->route('tickets.index');
    }

    public function render(): View
    {
        return view('livewire.create-tickets');
    }
}
