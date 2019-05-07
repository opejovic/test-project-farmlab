<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddAvatarTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	function unauthorized_users_cant_add_avatars()
	{
		$this->json('POST', 'users/1/avatars', [])->assertStatus(401);
	}

	/** @test */
	function avatar_must_be_a_valid_avatar_image()
	{
		auth()->login($user = factory(User::class)->create());
		$this->json('POST', "users/{$user->id}/avatars", [
			'avatar' => 'invalid-file-type',
		])->assertStatus(422);
	}

	/** @test */
	function authorized_users_can_upload_avatars_for_their_profiles()
	{
		auth()->login($user = factory(User::class)->create());

		Storage::fake();
		$file = UploadedFile::fake()->image('avatar.jpg');

		$this->json('POST', "users/{$user->id}/avatars", [
			'avatar' => $file,
		]);

		Storage::disk('public')->assertExists("avatars/{$file->hashName()}");
		$this->assertEquals("avatars/{$file->hashName()}", $user->avatar_path);
	}
}
