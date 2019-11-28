<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\User;
use App\Models\LabResult;
use App\Http\Requests\VetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $practice = Auth::user()->practice;

        return view('vets.index', [
            'practice' => $practice,
            'vets' => $practice->allVets(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('vets.create', ['practice' => Auth::user()->practice]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param VetRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VetRequest $request)
    {
        $practice = Auth::user()->practice;

        $practice->addVet(request('name'), request('email'));

        flash('New vet added to the team.');

        return redirect(route('vets.index', $practice));
    }

    /**
     * Display the specified resource.
     *
     * @param $hashid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($hashid)
    {
        $vet = User::findByHashid($hashid);

        $this->authorize('view', $vet);

        return view('vets.show', [
            'vet'              => $vet,
            'practice'         => $vet->practice,
            'results'          => $vet->results,
            'processedResults' => $vet->results->filter->isProcessed(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $vet)
    {
        $this->authorize('delete', $vet);

        $vet->delete();

        flash('Vet successfully removed.');

        return redirect(route('vets.index', $vet->practice));
    }
}
