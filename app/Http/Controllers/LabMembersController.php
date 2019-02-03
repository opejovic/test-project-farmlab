<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabMemberRequest;
use App\Models\File;
use App\Models\Practice;
use App\Models\User;
use Illuminate\Http\Request;

class LabMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('labmember.index', ['members' => User::labMembers()->paginate(12)]);
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

        flash('New member added to the team.');

        return redirect(route('members.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('labmember.show', [
            'member' => User::labMembers()->findOrFail($id), 
            'practicesCreated' => $member->createdPractices()->count(),
        ]);
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
        abort_if(User::find($id)->isAdmin(), 403);

        User::findOrFail($id)->delete();

        flash('Lab member successfully removed.');

        return redirect(route('members.index'));
    }
}
