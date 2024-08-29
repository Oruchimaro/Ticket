<x-filament::section class="mx-auto max-w-7xl items-center justify-center">
	<x-slot name="heading">User Login</x-slot>

	<form wire:submit="authenticate" class="mx-auto max-w-7xl items-center justify-center">
		{{ $this->form }}

		<x-filament::button type="submit" class="submit-btn">Login</x-filament::button>
	</form>
</x-filament::section>
