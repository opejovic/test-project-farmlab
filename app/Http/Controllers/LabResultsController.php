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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
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
        abort_unless(
            auth()->user()->practice_id == $labresult->practice_id, 403
        );

        return view('labresults.show', compact('labresult'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabResult $labresult
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(LabResult $labresult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LabResult           $labresult
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessLabResultRequest $request, LabResult $labresult)
    {
        $labresult->process();

        session()->flash('message', [
            'title' => 'Success!',
            'text'  => 'Labresult proccessed successfully.',
            'type'  => 'success'
        ]);

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
