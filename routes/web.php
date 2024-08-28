<?php

use App\Livewire\CreateTickets;
use App\Livewire\ListTickets;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('tickets', ListTickets::class)->name('tickets.index');
Route::get('tickets/create', CreateTickets::class)->name('tickets.create');
