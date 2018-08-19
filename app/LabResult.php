<?php

namespace App;

use App\File;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
	protected $guarded = [];

    public function practice()
    {
    	return $this->belongsTo(Practice::class);
    }

    public function parseToDb($file)
    {
      
    }
}
