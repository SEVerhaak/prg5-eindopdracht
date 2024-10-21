<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

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
            return view('add-file');
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
            'img' => 'required', // File validation
        ]);

        $album = new Album();
        $album->name = $request->input('title');
        $album->artist = $request->input('artist');
        $album->year = $request->input('year');

        // Handle the image file
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageBlob = file_get_contents($image->getRealPath()); // Convert image to BLOB
            $album->image = $imageBlob;
        }

        // $album->image = $this->prepareImage($request);

        $album->image_url = null; // add logic
        $album->genre_id = 1; // add logic
        $album->user_id = @auth()->id(); // add logic

        $album->save();

        return redirect()->route('welcome');
    }

    public function prepareImage($request)
    {
        $path = $request->input('img')->getRealPath();
        $logo = file_get_contents($path);
        return base64_encode($logo);
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
