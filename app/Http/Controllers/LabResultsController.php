<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessLabResultRequest;
use App\Models\LabResult;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabResultsController extends Controller
{
    /**
     * Displays the results. If there are no unprocessed results, displays processed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $practice = Auth::user()->practice;

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
    public function show($hashid)
    {
<<<<<<< HEAD:app/Http/Controllers/PracticeLabResultsController.php
        $labresult = LabResult::findByHashid($hashid);

        // Temporary - use policies
        abort_unless($labresult->practice_id === auth()->user()->practice_id, 404);
=======
        $practice = Auth::user()->practice;
>>>>>>> 0d996f9d46a0e712ae15a3d187784fddb24469e2:app/Http/Controllers/LabResultsController.php

        return view('labresults.show', [
            'labresult' => $practice->results()->findByHashid($hashid),
            'practice'  => $practice,
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
    public function update(ProcessLabResultRequest $request, $hashid)
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
    public function destroy(LabResult $labresult)
    {
        //
    }
}
