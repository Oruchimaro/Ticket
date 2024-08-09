<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Observers\TicketObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * we can use the attribute Illuminate\Database\Eloquent\Attributes\ObservedBy to register
         * observer on the model directly or register it here, I prefer the attribute way
         */
        // Ticket::observe(TicketObserver::class);
    }
}
