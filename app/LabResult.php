<?php

namespace App;

use App\Mail\Welcome;
use App\Practice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    const PROCESSED = 'PROCESSED';
    const UNPROCESSED = 'UNPROCESSED';
	protected $guarded = [];


    public function practice()
    {
    	return $this->belongsTo(Practice::class);
    }

    public function scopeResults($query, $status)
    {
        $vet = auth()->user()->practice_id;
        return $query->latest()
                ->where('status', $status)
                ->where('practice_id', $vet);
    }

    public function scopeToday($query)
    {
        $today = Carbon::today()->toDateString();
        return $query->where('date_of_test', $today);
    
    }
    public static function getUnprocessed()
    {   
        return static::results(LabResult::UNPROCESSED);
    }

    public static function getProcessed()
    {   
        return static::results(LabResult::PROCESSED);
    }

    // Parse the result from the request()->file -- need to figure out how to parse it from storage/s3.

    public static function parseAndSave($file)
    {  

        $handle = fopen($file, 'r');
        fgetcsv($handle);         //Adding this line will skip the reading of the 
        //first line from the csv file and the reading process will begin 
        //from the second line onwards. 
        //((fgetcsv parses the first line (header) and returns an array 
        //with those columns. Implicitly, the file pointer is now on the 2nd row.))

             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                  static::create([ 
                        'herd_number' => $data[0],
                        'date_of_arrival' => $data[1],
                        'date_of_test' => $data[2],
                        'animal_id' => $data[3],
                        'lab_code' => $data[4],
                        'test_name' => $data[5],
                        'type_of_samples' => $data[6],
                        'reading' => $data[7],
                        'interpretation' => $data[8],
                        'farmer_name' => $data[9],
                        'vet_comment' => $data[10],
                        'vet_indicator' => $data[11], 
                        'practice_id' => $data[12],
                        'practice_name' => Practice::name($data[12])    
                        // 'practice_name' => Practice::whereId($data[12])->first()->name
                    ]);

                  // For this to work, it needs a queue:listen command in terminal and .env file QUEUE_DRIVER set to database. Need to refactor this -- use Eventing instead?
                  // \Mail::to(App\User::wherePracticeId($data[12])->first()->email)->queue(new Welcome);
                }
            fclose($handle);
    }

    public function processResult($request)
    {
    	$this->whereId($this->id)
            ->update([
                'vet_comment' => $request->vet_comment, 
                'vet_indicator' => $request->vet_indicator,
                'vet_id' => auth()->user()->id,
                'status' => LabResult::PROCESSED
            ]);
        session()->flash('message', 'Lab result successfully processed');
    }
}