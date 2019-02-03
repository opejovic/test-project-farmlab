<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessLabResultRequest;
use App\Models\LabResult;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;

class PracticeLabResultsController extends Controller
{
    /**
     * Displays the results. If there are no unprocessed results, displays processed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Practice $practice)
    {
        // Temporary
        abort_unless($practice->id === auth()->user()->practice_id, 403);

        return view('labresults.index', [
            'labResults' => $practice->results()->get(), 
            'practice'   => $practice
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabResult $result
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Practice $practice, LabResult $labresult)
    {
        // Temporary - use policies
        abort_unless($practice->id === auth()->user()->practice_id, 403);

        return view('labresults.show', [
            'practice' => $practice,
            'labresult' => $labresult
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LabResult           $labresult
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessLabResultRequest $request, Practice $practice, Labresult $labresult)
    {
        abort_unless($practice->id === auth()->user()->practice_id, 403);

        auth()->user()->processResult($labresult, request('vet_comment'), request('vet_indicator'));

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
    public function destroy(Practice $practice, LabResult $labresult)
    {
        //
    }
}
