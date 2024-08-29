<?php

use App\Livewire;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('tickets.index'));

Route::group([
    'middleware' => 'auth',
    'prefix' => 'tickets',
    'as' => 'tickets.',
], function () {
    Route::get('', Livewire\ListTickets::class)->name('index');
    Route::get('create', Livewire\CreateTickets::class)->name('create');
    Route::get('{ticket}/edit', Livewire\EditTickets::class)->name('edit');
});

Route::get('login', Livewire\UserLogin::class)->name('login');
