<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\ValidateCsv;
use App\Jobs\ParseAndInsert;
use App\LabResult;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LabResultController extends Controller
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
        if (auth()->user()->type === User::VET) {
        $vet = auth()->user()->practice_id;
        $results = LabResult::where('practice_id', '=', "$vet")->get();

        return view('labresult.index', compact('results'));

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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {      

        return redirect()->home();

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\LabResult  $labResult
     * @return \Illuminate\Http\Response
     */
    public function show(LabResult $labResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabResult  $labResult
     * @return \Illuminate\Http\Response
     */
    public function edit(LabResult $labResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabResult  $labResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabResult $labResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabResult  $labResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabResult $labResult)
    {
        //
    }
}
