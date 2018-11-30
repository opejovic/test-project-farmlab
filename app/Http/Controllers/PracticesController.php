<?php

namespace App\Http\Controllers;

use App\Http\Requests\PracticeRequest;
use App\Models\Practice;
use App\Models\User;
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
        $practices = Practice::fetchAll()->paginate(9);

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
     * @param PracticeRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PracticeRequest $request)
    {
        auth()->user()->addPractice();
        
        session()->flash('message', [
            'title' => 'Success!',
            'text'  => 'New Practice team added successfully.',
            'type'  => 'success'
        ]);        

        return redirect(route('practice.index'));
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
        $vets = $practice->vets;
        return view('practice.show', compact('practice', 'vets'));
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
