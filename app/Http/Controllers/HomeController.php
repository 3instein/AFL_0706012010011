<?php

namespace App\Http\Controllers;

use App\Models\Update;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('index', [
            'updates' => Update::all()
        ]);
    }

    public function play(){
        return view('play');
    }

    public function leaderboard(){
        return view('leaderboard', [
            'players' => User::orderBy('rating', 'DESC')->take(1000)->get()
        ]);
    }
}