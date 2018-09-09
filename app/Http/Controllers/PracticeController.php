<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMemberOrPracticeForm;
use App\Mail\Welcome;
use App\Practice;
use App\User;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * If the authenticated user is of type admin, return admin view
     * Else if authenticated user is a farmlab member, return member view.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (auth()->user()->type === User::ADMIN) {
            return view('farmlab.admin');
        } elseif (auth()->user()->type === User::FARM_LAB_MEMBER) {
            return view('farmlab.member');
        }

        return redirect()->home();
    }

    /**
     * Store a newly created resource in storage.
     *
     * Adds new FL member if the auth user is admin / or  practice (and practice admin, (if the auth user is
     * FARMLAB_MEMBER)).
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddMemberOrPracticeForm $form)
    {

        $form->persist();

        \Mail::to(request('email'))->queue(new Welcome);

        return redirect()->home();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practice $practice
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Practice $practice
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Practice $practice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Practice            $practice
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Practice $practice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Practice $practice
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Practice $practice)
    {
        //
    }
}
