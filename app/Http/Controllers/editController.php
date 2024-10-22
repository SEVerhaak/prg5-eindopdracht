<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;

class editController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(auth()->check()) {
            $album = Album::findOrFail($id);  // Get the albumController by ID or fail
            $genre = Genre::all();  // Get all genres

            return view('edit', compact('album', 'genre'));  // Pass albumController and genre to the view
        } else {
            return redirect()->route('login');  // Redirect to login if not authenticated
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {

        //dd($albumController);

        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:2024',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|exists:genres,id',
        ]);

        //Album::findOrFail($albumController->id)->update(['title' => $request->input("title")]);

        $album->name = $request->input('title');
        $album->artist = $request->input('artist');
        $album->year = $request->input('year');
        $album->genre_id = $request->input('genre');

        if ($request->hasFile('img')) {
            if ($album->image_url) {
                \Storage::delete($album->image_url);
            }

            $path = $request->file('img')->store('albums', 'public');
            $album->image_url = '/storage/' . $path;
        }

        $album->save();

        return redirect()->route('edit-albumController.show', $album->id)->with('success', 'Album updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
