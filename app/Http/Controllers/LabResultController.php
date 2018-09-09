<?php

namespace App\Http\Controllers;

use App\LabResult;
use App\User;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays the results. If there are no unprocessed results,
     * display processed results.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LabResult $labResult)
    {
        if (auth()->user()->type === User::VET || auth()->user()->type === User::PRACTICE_ADMIN) {

            $resultsByStatus = $labResult->getResultsByStatus();
            $allResults = $labResult->getAllResults();
            return view('labresults.index', compact('resultsByStatus', 'allResults'));

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
    public function edit(Request $request, LabResult $result)
    {
        $result->processResult($request);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LabResult  $result
     * @return \Illuminate\Http\Response
     */
    public function update(LabResult $result)
    {
        
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
