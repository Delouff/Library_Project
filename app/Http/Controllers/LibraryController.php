<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libraries = Library::all();
        return response()->json($libraries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
                'name' => ['required' , 'string' , 'max:255'],
                'number' => ['required' , 'string' , 'max:10'],
                'track_type' => ['required', 'string', 'max:50'],
                'street' => ['required', 'string', 'max:255' ],
                'city' => ['required', 'string', 'max:255']
                ]);

        $libraries = new Library();
        $libraries->name = $validated['name'];
        $libraries->number = $validated['number'];
        $libraries->track_type = $validated['track_type'];
        $libraries->street = $validated['street'];
        $libraries->city = $validated['city'];
        $libraries->save();
        return $libraries;
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        return $library;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        //
    }
}
