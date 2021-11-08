<?php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('updates.create');
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
            'title' => ['required'],
            'thumbnail_path' => ['required', 'image', 'file', 'max:2048'],
            'patch_code' => ['required', 'unique:updates'],
            'description' => ['required']
        ]);

        $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('thumbnails', 'public');

        Update::create($validatedData);

        return redirect()->route('home')->with('success', 'Update Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function show(Update $update)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function edit(Update $update)
    {
        return view('updates.edit', [
            'update' => $update
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Update $update)
    {
        $validatedData = $request->validate([
            'title' => ['required'],
            'thumbnail_path' => ['image', 'file', 'max:2048'],
            'patch_code' => ['required', Rule::unique('updates')->ignore($update->patch_code, 'patch_code')],
            'description' => ['required']
        ]);

        if ($request->file('thumbnail_path')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('thumbnail_path-photo', 'public');
        }

        $update->update($validatedData);

        return redirect()->route('home')->with('success', 'Changes Saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Update  $update
     * @return \Illuminate\Http\Response
     */
    public function destroy(Update $update)
    {
        $update->delete();

        return back()->with('success', 'Update deleted!');
    }
}
