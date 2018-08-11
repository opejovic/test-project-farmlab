<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    public function practice()
    {
    	$this->belongsTo(Practice::class)
    }
}
