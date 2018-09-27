<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    /**
     * Displays the results. If there are no unprocessed results,
     * display processed results. If there is a farmer in the URI (If the user filters the results by farmer name),
     * then return the results belonging to that farmer.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LabResult $labResult, $farmerName = null)
    {
        $farmerName ? $allResults = $labResult->fetchByFarmer($farmerName) : $allResults = $labResult->fetchAll();

        $resultsByStatus = $labResult->fetchByStatus();

        return view('labresults.index', compact('resultsByStatus', 'allResults'));
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
    public function show(LabResult $result)
    {
        if (auth()->user()->practice_id !== $result->practice_id) {
            return redirect('home');
        }
        return view('labresults.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LabResult $result
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(LabResult $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LabResult           $result
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LabResult $result)
    {
        $result->process();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LabResult $result
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabResult $result)
    {
        //
    }
}
