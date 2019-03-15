<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewingInvitationTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	function viewing_unused_invitations()
	{
	    $invitation = factory(Invitation::class)->create([
	    	'user_id' => null,
	    	'code' => 'TESTCODE1234',
	    ]);

	    $response = $this->get('/invitations/TESTCODE1234');

	    $response->assertStatus(200);
	    $response->assertViewIs('invitations.show');
	    $response->assertViewHas('invitation');
	}

	/** @test */
	function viewing_used_invitations()
	{
	    $invitation = factory(Invitation::class)->create([
	    	'user_id' => 1,
	    	'code' => 'TESTCODE1234',
	    ]);

	    $response = $this->get('/invitations/TESTCODE1234');

	    $response->assertStatus(404);
	}

	/** @test */
	function viewing_non_existing_invitations()
	{
	    $response = $this->get('/invitations/TESTCODE1234');

	    $response->assertStatus(404);
	}
}
