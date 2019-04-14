<?php

use App\Facades\UserHashid;
use App\Models\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('invite-admin {name} {email}', function ($name, $email) {
	$admin = User::create([
		'name' => $name,
		'email' => $email,
		'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
		'type' => User::ADMIN,
	]);

	$admin->update(['hash_id' => UserHashid::generateFor($admin)]);
})->describe('Create an FarmLab Administrator. Name and email are required.');
