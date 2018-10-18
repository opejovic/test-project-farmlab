<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\ValidateCsv;
use App\Models\User;
use Illuminate\Http\Request;


class FileController extends Controller
{
    /**
     * Show the form for the file upload.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        return view('file.create');
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
            return redirect()->back()->withErrors(['Whoops, theres something wrong with your CSV file.']);
        }

        $file->upload();

        return back();
    }
}
