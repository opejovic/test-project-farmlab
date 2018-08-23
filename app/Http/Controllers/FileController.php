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
        if (! $request->checkHeader()) {
			return redirect()->back()->withErrors(['Whoops, theres something wrong with your CSV data.']);   
        }

        // If we upload the file to DB, but we delete it from our storage, and we try to upload it again we will throw an exception -> you cant have two same files in the DB.

    	try {

    		$file->upload();
    		
    	} catch (\Exception $e) {

    		return redirect()->back()->withErrors(['Sorry, that file is already uploaded.']);
    	}

        return back();
    }
}
