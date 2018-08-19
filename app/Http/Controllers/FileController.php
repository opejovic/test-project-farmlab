<?php

namespace App\Http\Controllers;


use App\File;
use App\Http\Requests\ValidateCsv;
use App\Jobs\ParseAndInsert;
use Illuminate\Http\Request;


class FileController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function create()
	{
		return view('file.create');
	}

    public function store(ValidateCsv $request, File $file)
    {    
    	$upload = request()->file('csv_file');
        $getPath = $upload->getRealPath();
        $csv_file = fopen($getPath, 'r');
        $header = fgetcsv($csv_file, 0, ',');

        $countheader = count($header); 

        if ($countheader < 14 && in_array('herd_number', $header) && in_array('date_of_arrival', $header) && in_array('date_of_test', $header) && in_array('animal_id', $header) && in_array('lab_code', $header) && in_array('test_name', $header) && in_array('type_of_samples', $header) && in_array('reading', $header) && in_array('interpretation', $header) && in_array('farmer_name', $header) && in_array('vet_comment', $header) && in_array('vet_indicator', $header) && in_array('practice_id', $header)) { 

            $file->upload();
  
        } else {

			return redirect()->back()->withErrors(['CSV file columns must be in this sequence  ...  only']);
        }
    	
    	$job = new ParseAndInsert(); 
    	$this->dispatch($job);

        return back();
    }
}
