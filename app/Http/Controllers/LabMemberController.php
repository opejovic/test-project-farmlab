<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LabMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::whereType(User::FARM_LAB_MEMBER)->paginate(12);

        return view('labmember.index', compact('members'));
    }

    /**
     * Show the form for creating a new farm lab team member.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labmember.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabMemberRequest $request)
    {
        auth()->user()->addFarmLabMember();

        if ($request->fails())
        {
            return response()->json(['errors'=>$request->errors()->all()]);
        }
        session()->flash('message', 'New FarmLab team member added.');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::whereType(User::FARM_LAB_MEMBER)->findOrFail($id);

        return view('labmember.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $user->delete();

        session()->flash('message', 'Lab member successfully deleted');

        return redirect('members');
    }
}
