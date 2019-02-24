<?php

namespace App\Providers;

use App\Events\LabResultCreated;
use App\Events\UserCreated;
use App\Listeners\SendResultCreatedNotification;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\VerifyEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreated::class => [
            SendWelcomeEmail::class,
        ],

        PasswordReset::class => [
            VerifyEmail::class,
        ],

        LabResultCreated::class => [
            SendResultCreatedNotification::class,
        ],        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
