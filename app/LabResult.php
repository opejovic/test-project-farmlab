<?php

namespace App;

use App\File;
use App\Mail\Welcome;
use App\Practice;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

    public static function parseAndSave()
    {  
        $path = request()->file('csv_file');
        $handle = fopen($path, 'r');
        fgetcsv($handle); //Adding this line will skip the reading of the first line from the csv file and the reading process will begin from the second line onwards. ((fgetcsv parses the first line (header) and returns an array with those columns. Implicitly, the file pointer is now on the 2nd row.))

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
                        'practice_name' => Practice::whereId($data[12])->first()->name
                    ]);

                  Mail::to(User::wherePracticeId($data[12])->first()->email)->queue(new Welcome);
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
                'status' => 'PROCESSED'
            ]);
        session()->flash('message', 'Lab result successfully processed');
    }
}