<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        \App\Events\NewsCreated::class => [
            \App\Listeners\SendNewsNotification::class,
        ],
        \App\Events\NewsStatusUpdated::class => [
            \App\Listeners\SendStatusUpdatedNotification::class,
        ],
        \App\Events\CommentAdded::class => [
            \App\Listeners\SendCommentNotification::class,
        ],
        \App\Events\LikeAdded::class => [
            \App\Listeners\SendLikeNotification::class,
        ],
        \App\Events\TitipTulisanStatusUpdated::class => [
            \App\Listeners\SendTitipTulisanStatusNotification::class,
        ],
        \App\Events\CategoryUpdated::class => [
            \App\Listeners\SendCategoryNotification::class,
        ],
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
