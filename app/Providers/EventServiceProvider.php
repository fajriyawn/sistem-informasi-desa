<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Failed;

use App\Models\Service;
use App\Observers\ServiceObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
    ],
    // PASTIKAN BARIS INI ADA
    Failed::class => [
        'App\Listeners\LogSuspiciousLoginAttempt',
    ],
];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        // --- DAFTARKAN OBSERVER ANDA DI SINI ---
        Service::class => [ServiceObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
