<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function saveProfile(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['email:rfc,dns'],
            'profile_photo_path' => ['image', 'file', 'max:2048']
        ]);

        $passwordCheck = Hash::check($request->password, $request->user()->password);

        if($request->file('profile_photo_path')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }

            $validatedData['profile_photo_path'] = $request->file('profile_photo_path')->store('profile-photo', 'public');
        }

        if(!$passwordCheck){
            return back()->with('failed', 'Wrong password!');
        }
    
        $request->user()->update($validatedData);

        return back()->with('success', 'Changes Saved!');
    }
}
