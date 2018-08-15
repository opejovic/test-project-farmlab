<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $guarded = [];

    public function vets()
    {
    	return $this->hasMany(User::class);
    }

    public function results()
    {
    	return $this->hasMany(LabResult::class);
    }

    // public function addNewPractice()
    // {
    //     $this->create([
    //         'name' => request('pname')
    //     ]);
    // }

}
