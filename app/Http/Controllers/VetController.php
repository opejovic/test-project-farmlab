<?php

namespace App\Http\Controllers;

use App\Http\Requests\VetRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vets = auth()->user()->allVets();

        return view('vets.index', compact('vets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vets.create');
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
        auth()->user()->addVet();
        session()->flash('message', 'New vet created.');

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
        abort_unless(auth()->user()->practice_id == $vet->practice_id, 404);

        $results = $vet->results()->paginate();

        return view('vets.show', compact('vet', 'results'));
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
        $vet = User::where('id', $id)->firstOrFail();
        $vet->delete();

        session()->flash('message', 'Vet successfully removed');

        return redirect('vets');
    }
}
