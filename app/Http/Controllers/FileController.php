<?php

namespace App\Http\Controllers;

use App\File;
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

    public function store(File $file)
    {
    	$file->upload();

    	$job = new ParseAndInsert();
    	$this->dispatch($job);

        return back();
    }
}
