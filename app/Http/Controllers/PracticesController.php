<?php

namespace App\Http\Controllers;

use App\Practice;
use App\User;
use Illuminate\Http\Request;

class PracticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            if (auth()->user()->type == 'ADMIN') {
                return view('farmlab.admin');
            } 
                return view('farmlab.member'); 
        
        }    

        return redirect()->home();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) {
            if (auth()->user()->type == User::ADMIN) {
                return view('farmlab.admin');
            } 
                return view('farmlab.member'); 
        
    } 

        return redirect()->home();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (auth()->user()->type === User::ADMIN) {
            User::addFarmLabMember();
        } elseif (auth()->user()->type === User::FARMLABMEMBER) {
            $practice = Practice::create([
                'name' => request('pname')
            ]);
            $user = new User;
            $user->addPracticeAdmin($practice);
        }

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function edit(Practice $practice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Practice $practice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practice $practice)
    {
        //
    }
}
