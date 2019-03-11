<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessLabResultRequest;
use App\Models\LabResult;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeLabResultsController extends Controller
{
    /**
     * Displays the results. If there are no unprocessed results, displays processed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Practice $practice)
    {
        abort_unless($practice->is(Auth::user()->practice), 403);

        return view('labresults.index', [
            'labResults' => $practice->results, 
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
    public function show(Practice $practice, $hashid)
    {
        abort_unless($practice->is(Auth::user()->practice), 404);

        return view('labresults.show', [
            'practice' => $practice,
            'labresult' => $practice->results()->findByHashid($hashid),
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
    public function update(ProcessLabResultRequest $request, Practice $practice, $hashid)
    {
        $labresult = Auth::user()->results()->findByHashid($hashid);

        $labresult->process(request('vet_comment'), request('vet_indicator'));

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
