<?php

namespace App\Models;

use App\Mail\InvitationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Finds the invitation by its code.
     *
     * @param  $code
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
