<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayController extends Controller
{
    public function index(Request $request){
        $user = $request->user();

        $ratingUpdate = 25 + mt_rand(1,10);

        $user->update([
            'rating' => $user->rating + $ratingUpdate
        ]);

        $user->fresh();

        $rating = $user->rating;

        if($rating >= 2000 && $rating < 2500){
            $user->update([
                'bracket_id' => 2
            ]);
        } else if($rating >= 2500 && $rating < 3000){
            $user->update([
                'bracket_id' => 3
            ]);
        } else if($rating >= 3000 && $rating < 4000){
            $user->update([
                'bracket_id' => 4
            ]);
        } else if($rating >= 4000 && $rating < 4500){
            $user->update([
                'bracket_id' => 5
            ]);
        } else if($rating >= 4500 && $rating < 5000){
            $user->update([
                'bracket_id' => 6
            ]);
        } else if($rating >= 5000 && $rating < 5500){
            $user->update([
                'bracket_id' => 7
            ]);
        } else if($rating >= 5500){
            $user->update([
                'bracket_id' => 8
            ]);
        }

        return back()->with('success', 'You got +'. $ratingUpdate . "");
    }
}
