<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCsv;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('files.index', ['files' => File::latest()->with('uploader')->paginate(10)]);
    }

    /**
     * If the validation passes, store the file in the storage.
     * 
     * @param ValidateCsv $request
     * @param File        $file
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCsv $request, File $file)
    {
        abort_unless($request->fileValidated(), 400, 'Something is wrong with your csv file.');
        
        $file->upload();

        return back();
    }
}
