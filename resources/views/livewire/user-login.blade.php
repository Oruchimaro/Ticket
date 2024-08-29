<x-filament::section class="items-center justify-center mx-auto max-w-7xl">
    <x-slot name="heading">
        User Login
    </x-slot>

    <form wire:submit="authenticate" class="items-center justify-center mx-auto max-w-7xl">
        {{ $this->form }}

        <x-filament::button type="submit" class="submit-btn">
            Login
        </x-filament::button>
    </form>
</x-filament::section>
