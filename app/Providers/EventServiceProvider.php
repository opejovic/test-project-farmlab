<?php

namespace App\Providers;

use App\Events\FileUploaded;
use App\Events\LabResultCreated;
use App\Events\UserCreated;
use App\Listeners\FlashFileUploadedSuccess;
use App\Listeners\FlashMemberSuccessfullyAdded;
use App\Listeners\SendResultCreatedNotification;
use App\Listeners\SendWelcomeEmail;
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
            FlashMemberSuccessfullyAdded::class,
            SendWelcomeEmail::class,
            // SendEmailVerificationNotification::class,
        ],

        LabResultCreated::class => [
            SendResultCreatedNotification::class,
        ],        

        FileUploaded::class => [
            FlashFileUploadedSuccess::class,
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
