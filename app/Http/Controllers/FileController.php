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
    	
    	$file->upload(); 

        return back();
    }
}
