<div>
    <x-slot name="heading">
        Update Ticket
    </x-slot>

    <form wire:submit="update" class="items-center justify-center mx-auto max-w-7xl">
        {{ $this->form }}

        <x-filament::button type="submit" class="submit-btn">
            Submit
        </x-filament::button>
    </form>
</div>
