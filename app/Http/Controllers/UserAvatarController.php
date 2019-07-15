<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAvatarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\LabMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
    	request()->validate([
    		'avatar' => [
    			'required', 
    			'image', 
        		// Rule::dimensions()->maxWidth(500)->maxHeight(500),
    		]
    	]); 

    	auth()->user()->update([
    		'avatar_path' => request()->file('avatar')->store('avatars', 'public')
    	]);

    	return back();
    }
}
