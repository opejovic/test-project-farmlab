<?php

namespace Tests\Feature;

use App\Models\LabResult;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpamDetectionTest extends TestCase
{
	use RefreshDatabase;
	
	/** @test */
	function lab_members_cannot_be_created_with_spam_name()
	{
		$admin = factory(User::class)->create(['type' => User::ADMIN]);

		$response = $this->actingAs($admin)
			->from("members/create")
			->post("members", [
			'name'     => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'email'    => 'valid@email.com',
		]);

	    $this->assertFalse(User::whereEmail('valid@email.com')->exists());
	    $response->assertRedirect("members/create");
	    $response->assertSessionHasErrors("name");
	}

	/** @test */
	function lab_members_cannot_be_created_with_spam_email()
	{
		$admin = factory(User::class)->create(['type' => User::ADMIN]);

		$response = $this->actingAs($admin)
			->from("members/create")
			->post("members", [
			'name'     => 'Valid Name',
            'email'    => 'aaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com',
		]);

	    $this->assertFalse(User::whereName('Valid Name')->exists());
	    $response->assertRedirect("members/create");
	    $response->assertSessionHasErrors("email");
	}

	/** @test */
	function practices_cannot_be_created_with_spam_name_admin_name_or_email()
	{
		$admin = factory(User::class)->create(['type' => User::ADMIN]);
		
		$response = $this->actingAs($admin)
			->from("practices/create")
			->post("practices", [
			'name'     		=> 'Invaaaaaaaaaaaaaaaaaaaaaaaalid',
            'admin_name'    => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'email'    		=> 'bbbbbbbbbbbbbbbbbbbbbbbbbb@email.com',
		]);

	    $response->assertRedirect("practices/create");
	    $response->assertSessionHasErrors("name");
	    $response->assertSessionHasErrors("admin_name");
	    $response->assertSessionHasErrors("email");
		$this->assertCount(0, Practice::all());
		$this->assertFalse(User::whereName('Valid Admin Name')->exists());
	}


	/** @test */
	function vets_cannot_be_created_with_spam_name()
	{
		$practiceAdmin = factory(User::class)->create(['type' => User::PRACTICE_ADMIN]);

		$response = $this->actingAs($practiceAdmin)
			->from("vets/create")
			->post("vets", [
			'name'     => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'email'    => 'valid@email.com',
		]);

	    $this->assertFalse(User::whereEmail('valid@email.com')->exists());
	    $response->assertRedirect("vets/create");
	    $response->assertSessionHasErrors("name");
	}

	/** @test */
	function vets_cannot_be_created_with_spam_email()
	{
		$practiceAdmin = factory(User::class)->create(['type' => User::PRACTICE_ADMIN]);

		$response = $this->actingAs($practiceAdmin)
			->from("vets/create")
			->post("vets", [
			'name'     => 'Valid Name',
            'email'    => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa@email.com',
		]);

	    $this->assertFalse(User::whereName('Valid Name')->exists());
	    $response->assertRedirect("vets/create");
	    $response->assertSessionHasErrors("email");
	}

	/** @test */
	function lab_results_cant_be_processed_with_spam_vet_comment()
	{
	    $vet = factory(User::class)->create(['type' => User::VET]);
	    $labResult = factory(LabResult::class)->create([
	    	'vet_id' => $vet->id,
	    	'hash_id' => 'XMPLHSID',
	    ]);
	    
	    $response = $this->actingAs($vet)
	    	->from("/labresults/{$labResult->hash_id}")
	    	->put("/labresults/{$labResult->hash_id}", [
	    		'vet_comment' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
	    		'vet_indicator' => 'Valid twenty characters Vet Indicator',
	    	]);

	    $response->assertRedirect("/labresults/{$labResult->hash_id}");
	    $response->assertSessionHasErrors('vet_comment');	
	}

	/** @test */
	function lab_results_cant_be_processed_with_spam_vet_indicator()
	{
	    $vet = factory(User::class)->create(['type' => User::VET]);
	    $labResult = factory(LabResult::class)->create([
	    	'vet_id' => $vet->id,
	    	'hash_id' => 'XMPLHSID',
	    ]);
	    
	    $response = $this->actingAs($vet)
	    	->from("/labresults/{$labResult->hash_id}")
	    	->put("/labresults/{$labResult->hash_id}", [
	    		'vet_comment' => 'Valid twenty characters Vet Comment',
	    		'vet_indicator' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa',
	    	]);

	    $response->assertRedirect("/labresults/{$labResult->hash_id}");
	    $response->assertSessionHasErrors('vet_indicator');	
	}
}
