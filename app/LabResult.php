<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
	protected $guarded = [];

    public function practice()
    {
    	return $this->belongsTo(Practice::class);
    }

    public function parseToDb()
    {
        
        $handle = fopen(storage_path('app/labresults') . '/OVtLEpkIjnzZ4e5vqHJmk0650HewBuuCWJmHsVpJ.txt', 'r');
        
        while ($data = fgetcsv($handle, 1000, ",")) {
                   $this->create([ 
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
                        'practice_id' => $data[12]
                    ]);
                }    	
    }
}
