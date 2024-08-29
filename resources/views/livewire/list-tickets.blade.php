<x-filament::section class="items-center justify-center mx-auto max-w-7xl">
    <x-slot name="heading">
        Tickets List
    </x-slot>

    <x-slot name="headerEnd">
        <x-filament::button wire:navigate href="{{ route('tickets.create') }}" tag="a">
            New Ticket
        </x-filament::button>
    </x-slot>

    {{ $this->table }}
</x-filament::section>
