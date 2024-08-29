<?php

namespace App\Observers;

use App\Models\Ticket;
use Filament\Notifications\Notification;

class TicketObserver
{
    public function created(Ticket $ticket): void
    {
        Notification::make()
            ->title(__('A ticket has been assigned to you'))
            ->body("Title : {$ticket->title}")
            ->success()
            ->sendToDatabase($ticket->assignedTo); // recipient is agent (assignedTo)
    }

    public function updated(Ticket $ticket): void
    {
        //
    }
}
