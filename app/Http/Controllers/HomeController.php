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
        }

        $destinations = [
            User::ADMIN => 'home.admin', compact('user', 'practice', 'file'),
            User::FARM_LAB_MEMBER => 'home.labmember', compact('user'),
            User::PRACTICE_ADMIN => 'home.practice', compact('user'),
            User::VET => 'home.vet', ['results' => $user->results, 'user' => $user]
        ];

        return view($destinations[$user->type]);
    }
}