<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // File validation with constraints
        ]);

        $album = new Album();
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

        // Additional album fields
        $album->image = null;
        $album->genre_id = 1; // Add logic for genre selection
        $album->user_id = auth()->id(); // Set the current user's ID

        // Save the album to the database
        $album->save();

        return redirect()->route('welcome');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
