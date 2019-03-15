<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    /**
     * Verifies the user when the user chooses a password, and uses the invitation.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify()
    {
        $invitation = Invitation::findByCode(request('invitation_code'));
        
        abort_if($invitation->hasBeenUsed(), 404);

        $user = User::whereEmail($invitation->email)->first();
        
        request()->validate([
            'email' => [
                'required', 
                'confirmed', 
                 Rule::unique('users')->ignore($user->id)
             ],
            'password'  => ['required', 'confirmed'],
        ]);

        $user->update([
            'email' => request('email'),
            'password'  => Hash::make(request('password')),
            'email_verified_at' => $user->freshTimestamp(),
        ]);

        $invitation->update(['user_id' => $user->id]);
        Auth::login($user);
        
        return redirect()->route('home');
    }
}
