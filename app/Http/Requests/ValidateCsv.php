<?php

namespace App\Http\Requests;

use App\File;
use App\Jobs\ParseAndInsert;
use Illuminate\Foundation\Http\FormRequest;

class ValidateCsv extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // public function rules()
    // {
    //     return [
    //         'csv_file' => 'required|file|mimes:csv, txt'
    //     ];
    // }

    public function rules()
    {  
        return [
            'csv_file' => 'required|file|mimes:csv,txt'
        ];
    }
    // Checks to see if the header columns are in the correct order

    public function checkHeader()
        {
            $upload = request()->file('csv_file');
            $getPath = $upload->getRealPath();
            $csv_file = fopen($getPath, 'r');
            $header = fgetcsv($csv_file, 0, ',');

            $countheader = count($header); 

        if ($countheader < 14 && in_array('herd_number', $header) && in_array('date_of_arrival', $header) && in_array('date_of_test', $header) && in_array('animal_id', $header) && in_array('lab_code', $header) && in_array('test_name', $header) && in_array('type_of_samples', $header) && in_array('reading', $header) && in_array('interpretation', $header) && in_array('farmer_name', $header) && in_array('vet_comment', $header) && in_array('vet_indicator', $header) && in_array('practice_id', $header)) { 
                return true;
        }           
            fclose($csv_file);
            
    }
}




