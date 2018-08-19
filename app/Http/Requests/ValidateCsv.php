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

        

    // return redirect()->back()->with('flash_message_success', 'Your Employee Schedule Uploaded successfully!');
        

    }




