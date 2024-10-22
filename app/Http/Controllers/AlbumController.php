<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            // Redirect to login page if not logged in
            return redirect()->route('login')->with('error', 'You must be logged in to view your albums.');
        } else{
            // Retrieve albums that belong to the authenticated user
            //$albums = Album::where('user_id', auth()->id())->get();

            // Pass the albums to the view
            //return view('item-page', ['albums' => $albums]);
            $albums = \App\Models\Album::where('user_id', auth()->id())->paginate(5);

            // Pass the paginated albums to the view
            return view('item-page', ['albums' => $albums]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->check()){
            $genre = Genre::all();
            return view('add-file', compact('genre'));
        } else{
            return view('auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'year' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // File validation with constraints
        ]);

        $album = new \App\Models\Album();
        $album->name = $request->input('title');
        $album->artist = $request->input('artist');
        $album->year = $request->input('year');

        // Handle the image file using Laravel's storage
        if ($request->hasFile('img')) {
            $image = $request->file('img');

            // Store the image in the 'public/albums' directory and get the path
            $path = $image->store('albums', 'public');

            // Save the file's URL in the image_url field
            $album->image_url = Storage::url($path);
        } else {
            $album->image_url = null; // Set to null if no image was uploaded
        }

        // Additional albumController fields
        $album->image = null;
        $album->genre_id = 1; // Add logic for genre selection
        $album->user_id = auth()->id(); // Set the current user's ID

        // Save the albumController to the database
        $album->save();

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::with('genre')->findOrFail($id);
        return view('show-album', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->check()){
            $genre = Genre::all();
            $album = Album::findOrFail($id);
            return view('edit', compact('album', 'genre'));
        } else{
            return view('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::findOrFail($id); // Get the albumController using the ID

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

        return redirect()->route('albums.show', $album->id)->with('success', 'Album updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::findOrFail($id); // Find the album or fail
        $album->delete(); // Delete the album

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!'); // Redirect after deletion
    }
}
