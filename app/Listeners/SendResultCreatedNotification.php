<?php

namespace App\Listeners;

use App\Events\LabResultCreated;
use App\Mail\NewResultNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendResultCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LabResultCreated  $event
     * @return void
     */
    public function handle(LabResultCreated $event)
    {
        Mail::to($event->labresult->vet->email)->queue(
            new NewResultNotification($event->labresult, $event->labresult->vet)
        );
    }
}
