<?php

namespace App\Jobs;

use App\File;
use App\LabResult;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseAndInsert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = request()->file('labresult');

        $handle = fopen($file, 'r');
        
        while ($data = fgetcsv($handle, 1000, ",")) {
                  LabResult::create([ 
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
                fclose($handle);
    }
}
