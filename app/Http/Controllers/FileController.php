<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCsv;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::paginate(10);

        return view('files.index', compact('files'));
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
        if (! $request->checkHeader()) {
            abort(400, 'There is something wrong with your csv file.');
        }

        $file->upload();

        session()->flash('message', [
            'title' => 'Success!',
            'text'  => 'File successfully uploaded.',
            'type'  => 'success'
        ]);

        return back();
    }
}
