<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function editProfile()
    {
        return view('users.profile.edit', ['user' => auth()->user()]);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
    	auth()->user()->update($request->validated());

    	session()->flash('success', 'profile settings updated');

    	return redirect()->back();
    }
}
