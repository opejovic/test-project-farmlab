<?php

namespace App\Http\Controllers;

use App\LabResult;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('index', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LabResult $labResult)
    {
        $user = auth()->user();

        // move business logic to service container?
        if (!\Auth::check()) {
            return view('home.guest');
        } elseif ($user->type === User::ADMIN) {
            return view('home.admin');
        } elseif ($user->type === User::FARM_LAB_MEMBER) {
            return view('home.member');
        } elseif ($user->type === User::PRACTICE_ADMIN) {
            return view('home.practice');
        } elseif ($user->type === User::VET) {
            $resultsByStatus = $labResult->getResultsByStatus();


            return view('home.vet', compact('resultsByStatus')); // tmp
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (!auth()->attempt(request(['email', 'password']))) {
            return back()->withErrors([
                'message' => 'Wrong credentials. Please try again.'
            ]);
        }

        session()->flash('message', 'You are now logged in.');
        return redirect()->home();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->logout();

        session()->flash('message', 'You have logged out.');

        return redirect()->home();
    }
}
