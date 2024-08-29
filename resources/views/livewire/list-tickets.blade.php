<x-filament::section class="mx-auto max-w-7xl items-center justify-center">
	<x-slot name="heading">Tickets List</x-slot>

	<x-slot name="headerEnd">
		<x-filament::button wire:navigate href="{{ route('tickets.create') }}" tag="a">New Ticket</x-filament::button>
	</x-slot>

	{{ $this->table }}
</x-filament::section>
