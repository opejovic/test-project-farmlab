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
        $members = User::labMembers()->paginate(12);
        
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

        session()->flash('message', [
            'title' => 'Success!',
            'text'  => "New member added to the team.",
            'type'  => 'success'
        ]);

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
        $member = User::labMembers()->findOrFail($id);
        $practicesCreated = $member->createdPractices()->count();

        return view('labmember.show', compact('member', 'practicesCreated'));
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
        User::findOrFail($id)->delete();

        session()->flash('message', [
            'title' => 'Done.',
            'text'  => 'Lab member successfully deleted.',
            'type'  => 'success'
        ]);

        return redirect(route('members.index'));
    }
}
