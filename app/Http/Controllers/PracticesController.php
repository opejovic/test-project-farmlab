<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;
use App\Http\Requests\PracticeRequest;
use Illuminate\Support\Facades\Auth;

class PracticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('practice.index', [
            'practices' => Practice::fetchAll()->paginate(12),
        ]);
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
     * @param PracticeRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PracticeRequest $request)
    {
        Auth::user()->addPractice();
        
        flash('New Practice team added successfully.');

        return redirect(route('practices.index'));
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
        return view('practice.show', [
            'practice' => $practice, 
            'vets' => $practice->vets,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Practice $practice
     *
     * @return void
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
     * @param Practice $practice
     *
     * @return void
     */
    public function destroy(Practice $practice)
    {
        //
    }
}
