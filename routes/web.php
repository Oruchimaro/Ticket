<?php

use App\Livewire\CreateTickets;
use App\Livewire\EditTickets;
use App\Livewire\ListTickets;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('tickets', ListTickets::class)->name('tickets.index');
Route::get('tickets/create', CreateTickets::class)->name('tickets.create');
Route::get('tickets/{ticket}/edit', EditTickets::class)->name('tickets.edit');
