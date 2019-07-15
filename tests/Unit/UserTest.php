<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	function it_can_get_avatar_path()
	{
	    $userWithAvatar = factory(User::class)->create([
	    	'avatar_path' => 'avatars/me.jpg'
	    ]);
	    $this->assertEquals('avatars/me.jpg', $userWithAvatar->avatar());
	    
	    $userWithoutAvatar = factory(User::class)->create([
	    	'avatar_path' => null,
	    ]);
	    $this->assertEquals('avatars/default.jpg', $userWithoutAvatar->avatar());

	}
}
