<div>
    <x-slot name="heading">
        Create Ticket
    </x-slot>

    <form wire:submit="create" class="items-center justify-center mx-auto max-w-7xl">
        {{ $this->form }}

        <x-filament::button type="submit" class="submit-btn">
            Submit
        </x-filament::button>
    </form>
</div>
