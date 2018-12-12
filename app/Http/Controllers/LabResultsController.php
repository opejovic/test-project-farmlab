<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessLabResultRequest;
use App\Models\LabResult;
use App\Models\User;
use Illuminate\Http\Request;

class LabResultsController extends Controller
{
    /**
     * Displays the results. If there are no unprocessed results,
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LabResult $labresult)
    {
        $allResults = $labresult->fetchAll();

        $resultsByStatus = $labresult->fetchByStatus();
        
        return view('labresults.index', compact('allResults', 'resultsByStatus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabResult $result
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LabResult $labresult)
    {
        return view('labresults.show', compact('labresult'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LabResult           $labresult
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessLabResultRequest $request)
    {
        auth()->user()->processResult(request('vet_comment'), request('vet_indicator'));

        flash('Labresult proccessed successfully.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabResult $labresult
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabResult $labresult)
    {
        //
    }
}
