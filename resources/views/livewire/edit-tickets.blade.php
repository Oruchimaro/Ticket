<x-filament::section class="mx-auto max-w-7xl items-center justify-center">
	<x-slot name="heading">Update Ticket</x-slot>

	<form wire:submit="update" class="mx-auto max-w-7xl items-center justify-center">
		{{ $this->form }}

		<x-filament::button type="submit" class="submit-btn">Submit</x-filament::button>
	</form>
</x-filament::section>
