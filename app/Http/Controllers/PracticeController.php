<?php

namespace App\Http\Controllers;

use App\User;
use App\Practice;
use App\Mail\Welcome;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(Request $request, User $user)
    {

        if (auth()->user()->type === User::ADMIN) {

            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
            ]);

            $user->addFarmLabMember();
            session()->flash('message', 'New FarmLab team member added.');



        } elseif (auth()->user()->type === User::FARMLABMEMBER) {
            
            $this->validate(request(), [
                'name' => 'required|unique:practices',
                'admin_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
            ]);

            $practice = Practice::create([
                'name' => request('name')
            ]);
            $user->addPracticeAdmin($practice);
            session()->flash('message', 'New practice created.');

        }

        \Mail::to(request('email'))->send(new Welcome);

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
