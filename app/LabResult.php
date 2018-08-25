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
    
    public static function getUnprocessed()
    {   
        $vet = auth()->user()->practice_id;
        return static::wherePracticeId($vet)
                    ->whereStatus('UNPROCESSED')
                    ->get();
    }

    public static function getProcessed()
    {   
        $vet = auth()->user()->practice_id;
        return static::wherePracticeId($vet)
                            ->whereStatus('PROCESSED')
                            ->get();  
    }

    public function processResult($request)
    {
    	$this->where('id', '=', "{$this->id}")
            ->update([
                'vet_comment' => $request->vet_comment, 
                'vet_indicator' => $request->vet_indicator,
                'vet_id' => auth()->user()->id,
                'status' => 'PROCESSED'
            ]);
        session()->flash('message', 'Lab result successfully processed');
    }
}
