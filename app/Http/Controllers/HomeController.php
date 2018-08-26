<?php

namespace App\Http\Controllers;

use App\LabResult;
use App\User;
use Illuminate\Http\Request;

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
    public function index()
    {

        // move business logic to service container?
        if (! \Auth::check()) {
            return view('home.guest');
        }

        elseif (auth()->user()->type === User::ADMIN) {
            return view('home.admin');
        }

        elseif (auth()->user()->type === User::FARMLABMEMBER) {
            return view('home.member');
        }

        elseif (auth()->user()->type === User::PRACTICEADMIN) {
            return view('home.practice');
        }

        elseif (auth()->user()->type === User::VET) {
            return redirect('labresults/index'); // tmp
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (! auth()->attempt(request(['email', 'password']))) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->logout();

        session()->flash('message', 'You have logged out.');

        return redirect()->home();
    }
}
