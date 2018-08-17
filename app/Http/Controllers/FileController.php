<?php

namespace App\Http\Controllers;

use App\File;
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

        return back();
    }
}
