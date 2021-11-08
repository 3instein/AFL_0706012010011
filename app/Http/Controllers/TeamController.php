<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $query = User::where('team_id', $request->user()->team_id)->get();

            if ($request->user()->team->admin_id == $request->user()->id) {
                return DataTables::of($query)
                    ->addColumn('action', function ($user) {

                        if ($user->id != auth()->user()->id) {
                            return '
                                    <div class="d-flex">
                                        <a href="' . route('teams.transfer', $user->id) . '" class="btn btn-warning me-1">Transfer</a>
                                        <form action="' . route('teams.remove', $user) . '" method="POST">
                                        ' . csrf_field() . '
                                        <button type="submit" class="btn btn-danger">
                                        Remove
                                        </button>
                                        </form>
                                    </div>
                                ';
                        }
                    })
                    ->editColumn('username', function ($user) {
                        $role = $user->id == $user->team->admin_id ? ' [ADMIN]' : '';
                        return $user->username . $role;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
            } else {
                return DataTables::of($query)
                    ->addColumn('action', function ($user) {
                        return '';
                    })
                    ->editColumn('username', function ($user) {
                        $role = $user->id == $user->team->admin_id ? ' [ADMIN]' : '';
                        return $user->username . $role;
                    })
                    ->rawColumns(['action'])
                    ->toJson();
            }
        }
        if (!$request->user()->team_id) {
            return redirect()->route('teams.create');
        } else {
            return view('teams.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            $query = Team::all();
            return DataTables::of($query)
                ->addColumn('players', function ($team) {
                    $players = $team->players->count();

                    return $players . '/5';
                })
                ->addColumn('rating', function ($team) {
                    $totalRating = 0;
                    foreach ($team->players as $player) {
                        $totalRating += $player->rating;
                    }
                    return $totalRating;
                })
                ->addColumn('action', function ($team) {
                    if ($team->players->count() < 5) {
                        return '
                                <div class="d-flex">
                                    <a href="' . route('teams.join', $team->id) . '" class="btn btn-warning me-1">Join</a>
                                </div>
                                ';
                    } else {
                        return '
                                <p class="text-danger">Team is full</p>
                                ';
                    }
                })
                ->rawColumns(['action'])
                ->make();
        }

        if (auth()->user()->team_id) {
            return redirect()->route('teams.index');
        } else {
            return view('teams.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:teams'],
            'tag' => ['required', 'unique:teams']
        ]);

        $validatedData['admin_id'] = $request->user()->id;

        $team = Team::create($validatedData);
        $request->user()->update([
            'team_id' => $team->id
        ]);

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('teams.show', [
            'team' => $team
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('teams.edit', [
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('teams', 'name')->ignore($team->name, 'name')],
            'tag' => ['required', Rule::unique('teams', 'tag')->ignore($team->tag, 'tag')]
        ]);

        $team->update($validatedData);

        return back()->with('success', 'Changes Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return back();
    }

    public function transfer(User $user)
    {
        $user->team->update([
            'admin_id' => $user->id
        ]);

        return back()->with('success', 'Administrator Changed!');
    }

    public function remove(User $user)
    {
        $user->update([
            'team_id' => null
        ]);

        return back()->with('success', 'Player Removed!');
    }

    public function leave(User $user)
    {
        if ($user->id != $user->team->admin_id) {
            $user->update([
                'team_id' => null
            ]);

            return back();
        }

        return back()->with('failed', 'You need to transfer admin first!');
    }

    public function join(Request $request, Team $team)
    {
        if ($team->players->count() != 5) {
            $request->user()->update([
                'team_id' => $team->id
            ]);
            return back();
        }
    }
}
