<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user =Auth::user();
        return view('dashboard.profile.edit',[
            'user'=>$user,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate
        (
            [
            'first_name'=>['required','string'],
            'last_name'=>['required','string'],
            'birthday'=>['nullable','date','before:today'],
            'gender'=>['in:male,female'],
            'country'=>['required','string','size:2'],
            ]
        );
        $user=$request->user();
        $user->profile->update($request->all());
    }
}
