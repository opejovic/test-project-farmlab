<?php

namespace Tests\Feature;

use App\Facades\InvitationCode;
use App\Mail\InvitationEmail;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class InviteUsersTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	function when_user_is_created_he_is_sent_an_invitation_link()
	{
		$this->withoutExceptionHandling();
	    $admin = factory(User::class)->create(['type' => User::ADMIN]);

		Mail::fake();
		InvitationCode::shouldReceive('generate')->andReturn('TESTCODE1234');
	    
	    $response = $this->actingAs($admin)->post('/members', [
            'name'     => 'John',
            'email'    => 'john@example.com',
            'password' => Hash::make(str_random(10)),
            'type'     => User::FARM_LAB_MEMBER,
	    ]);

	    $this->assertEquals(1, Invitation::count());
	    $invitation = Invitation::first();
	    $this->assertEquals('john@example.com', $invitation->email);
	    $this->assertEquals('TESTCODE1234', $invitation->code);
	    Mail::assertQueued(InvitationEmail::class, function($mail) use ($invitation) {
	    	return $mail->hasTo('john@example.com') 
	    		&& $mail->invitation->is($invitation);
	    });
	}
}
