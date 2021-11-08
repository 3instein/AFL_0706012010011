<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/play', [HomeController::class, 'play'])->name('play');
    Route::post('/play', [PlayController::class, 'index'])->name('index-play');
    Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');
    Route::get('/teams/{team}/join', [TeamController::class, 'join'])->name('teams.join');
    Route::get('/teams/{user}/transfer', [TeamController::class, 'transfer'])->name('teams.transfer');
    Route::post('/teams/{user}/remove', [TeamController::class, 'remove'])->name('teams.remove');
    Route::get('/teams/{user}/leave', [TeamController::class, 'leave'])->name('teams.leave');
    Route::resource('teams', TeamController::class);
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile', [UserController::class, 'saveProfile'])->name('saveProfile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
