<?php

namespace App\Http\Controllers;

use App\Http\Requests\PracticeRequest;
use App\Models\Practice;
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
        $practices = Practice::oldest()->get();

        return view('practice.index', compact('practices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Adds new FL member if the auth user is admin / or  practice (and practice admin, (if the auth user is
     * FARMLAB_MEMBER)).
     *
     * @param  \Illuminate\Http\Requests\AddMemberOrPracticeForm $form
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PracticeRequest $request)
    {
        auth()->user()->addPractice();
        session()->flash('message', 'New practice created.');

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Practice $practice
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice)
    {
        return view('practice.show', compact('practice'));
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
     * @param  \App\Models\Practice            $practice
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
