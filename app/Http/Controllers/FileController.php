<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCsv;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Show the form for the file upload and all the files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $files = File::paginate(10);

        return view('files.index', compact('files'));
    }

    /**
     * @param ValidateCsv $request
     * @param File        $file
     *
     * If the validation passes, store the file in the storage
     *
     *
     * @return \Illuminate\Http\RedirectResponse
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
