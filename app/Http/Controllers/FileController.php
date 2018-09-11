<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\ValidateCsv;
use App\User;
use Illuminate\Http\Request;


class FileController extends Controller
{
    /**
     * Show the form for the file upload, if the signed in user is of the ADMIN or FARM_LAB_MEMBER type.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->type === User::ADMIN || $user->type === User::FARM_LAB_MEMBER) {
            return view('file.create');
        }

        return redirect()->home();
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
        if (!$request->checkHeader()) {
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
