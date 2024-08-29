<x-filament::section class="mx-auto max-w-7xl items-center justify-center">
	<x-slot name="heading">Create Ticket</x-slot>

	<form wire:submit="create" class="mx-auto max-w-7xl items-center justify-center">
		{{ $this->form }}

		<x-filament::button type="submit" class="submit-btn">Submit</x-filament::button>
	</form>
</x-filament::section>
