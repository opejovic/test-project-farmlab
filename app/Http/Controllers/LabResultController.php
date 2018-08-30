<?php

namespace App\Http\Controllers;

use App\File;
use App\LabResult;
use App\User;
use Carbon\Carbon;
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
        if (auth()->user()->type === User::VET || auth()->user()->type === User::PRACTICEADMIN) {
            // need to refactor this asap
            $query = LabResult::getUnprocessed()->get();

            if ($query->count() > 0) {
                // if there are any unprocessed results from today show them, else show all unprocessed 
                $results = LabResult::getUnprocessed()->today()->get();
                if (count($results)) {
                    return view('labresults.index', compact('results'));
                } else {
                    $results = LabResult::getUnprocessed()->get();
                    return view('labresults.index', compact('results'));
                }

            } else {
                // if there are any processed results from today show them, else show all processed 
                $results = LabResult::getProcessed()->get();
                if ($results->count() > 0) {
                    return view('labresults.index', compact('results'));
                } else {
                    $results = LabResult::getProcessed()->today()->get();
                    return view('labresults.index', compact('results'));
                }    

            } 
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
    public function store(LabResult $labResult)
    {      

        return redirect()->home();

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\LabResult  $result
     * @return \Illuminate\Http\Response
     */
    public function show(LabResult $result)
    {
        return view('labresults.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabResult  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(LabResult $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabResult $result)
    {
        $result->processResult($request);

        return redirect('/labresults/index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabResult  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabResult $result)
    {
        //
    }
}
