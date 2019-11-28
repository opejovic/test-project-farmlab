<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\LabResult;
use App\Models\Practice;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Return a home view, depending on the users type.
     *
     * @param  LabResult $labresult
     * @param  Practice  $practice
     * @param  File      $file
     * @return \Illuminate\Http\Response
     */
    public function index(LabResult $labresult, Practice $practice, File $file)
    {
        $user = auth()->user();

        if (auth()->guest()) {
            return view('auth.login');

        } elseif ($user->type === User::ADMIN) {
            return view('home.admin', compact('user', 'practice', 'file'));

        } elseif ($user->type === User::FARM_LAB_MEMBER) {
            return view('home.labmember', compact('user'));

        } elseif ($user->type === User::PRACTICE_ADMIN) {
            return view('home.practice', compact('user'));

        } elseif ($user->type === User::VET) {
            $results = auth()->user()->results;
            return view('home.vet', compact('results', 'user'));
        }
    }
}
