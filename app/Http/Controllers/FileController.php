<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\ValidateCsv;
use App\User;
use Illuminate\Http\Request;


class FileController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create()
	{
        if (auth()->user()->type === User::ADMIN || auth()->user()->type === User::FARMLABMEMBER) {
		  return view('file.create');
        }

        return redirect()->home();
	}

    public function store(ValidateCsv $request, File $file)
    {    
        if (! $request->checkHeader()) {
			return redirect()->back()->withErrors(['Whoops, theres something wrong with your CSV file.']);   
        }
        // If we upload the file to DB, but we delete it from our storage, and we try to upload it again we will throw an exception -> you cant have two same files in the DB.
    	// try {
    		$file->upload();
    	// } catch (\Exception $e) {
            // return $e->getMessage();
    		// return redirect()->back()->withErrors([$e]);
    	// }

        return back();
    }
}
