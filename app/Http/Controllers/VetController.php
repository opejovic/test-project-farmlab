<?php

namespace App\Http\Controllers;

use App\Http\Requests\VetRequest;
use App\Mail\Welcome;
use App\Models\User;
use Illuminate\Http\Request;

class VetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $vets = $user->allVets();

        return view('practice.vets', compact('vets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practice.admin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param VetRequest $request
     * @param User       $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VetRequest $request, User $user)
    {
        $user->addVet();
        session()->flash('message', 'New vet created.');

        \Mail::to(request('email'))->queue(new Welcome);

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param User $vet
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $vet)
    {
        if (auth()->user()->practice_id !== $vet->practice_id) {
            return back();
        }
        return view('practice.vet', compact('vet'));
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
