<?php

namespace App\Models;

use App\Mail\InvitationEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Invitation extends Model
{
    protected $guarded = [];

    /**
     * Finds the invitation by its code.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public static function findByCode($code)
    {
    	return self::whereCode($code)->firstOrFail();
    }

    /**
     * Checks if the invitation has been used.
     *
     * @return boolean
     */
    public function hasBeenUsed()
    {
        return $this->user_id !== null;
    }

    /**
     * Sends the invitation to the newly created user.
     *
     * @return void
     */
    public function send()
    {
        Mail::to($this->email)->queue(new InvitationEmail($this));
    }
}
