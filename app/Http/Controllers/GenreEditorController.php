<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if user is logged-in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit genres.');
        }

        $this->checkAdmin();

        $genres = Genre::all();

        return view('genres.index', compact('genres'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // check if user is logged-in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create genres.');
        }

        $this->checkAdmin();

        return view('genres.add-genre');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if user is logged-in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to save new genres.');
        }

        $this->checkAdmin();

        $request->validate([
            'name' => 'required',
        ]);

        $genre = new \App\Models\Genre();

        $genre->name = $request->input('name');

        $genre->save();

        return redirect()->route('genres.index')->with('success', 'Genre created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(403, 'This page has not been made :)');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // check if user is logged-in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit genres.');
        }

        // check if the user is an admin
        $this->checkAdmin();

        // get the genre from the database
        $genre = \App\Models\Genre::findOrFail($id);

        // send the genre to the view
        return view('genres.edit-genre', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to update genres.');
        }

        // check if the user is an admin
        $this->checkAdmin();

        // check the data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // find the correct genre to edit
        $genre = \App\Models\Genre::findOrFail($id);

        // update the genre
        $genre->name = $request->input('name');
        $genre->save();

        // redirect back to a suitable page with a success message
        return redirect()->route('genres.index')->with('success', 'Genre updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // check if the user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete genres.');
        }

        // check if the user is an admin
        $this->checkAdmin();

        // find the genre by its ID and delete it
        $genre = \App\Models\Genre::findOrFail($id);
        $genre->delete();

        // redirect back with a success message
        return redirect()->route('genres.index')->with('delete', 'Genre deleted successfully!');
    }


    private function checkAdmin()
    {
        $userRole = \App\Models\User::where('id', auth()->id())->value('role');

        // Ensure that only users with role 1 or 2 can perform this action
        if ($userRole !== 1 && $userRole !== 2) {
            abort(403, 'Unauthorized action.');
        }
    }
}
