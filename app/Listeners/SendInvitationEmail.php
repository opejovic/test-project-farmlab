<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Facades\InvitationCode;
use App\Mail\Welcome;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendInvitationEmail
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Invitation::create([
            'email' => $event->user->email,
            'code'  => InvitationCode::generate()
        ])->send();
    }
}
