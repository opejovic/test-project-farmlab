<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    public function vets()
    {
    	$this->hasMany(User::class);
    }

    public function results()
    {
    	$this->hasMany(LabResult::class);
    }
}
