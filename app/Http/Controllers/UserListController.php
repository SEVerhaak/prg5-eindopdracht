<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the users.');
        }

        // Get all users where 'is_public' is set to 1 and count the albums for each user
        $users = \App\Models\User::where('is_public', 1)
            ->withCount('albums') // Add album count to the query
            ->paginate(10);

        return view('users.index', compact('users'));
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
    public function show(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the users.');
        }

        // Fetch the user by ID
        $user = \App\Models\User::findOrFail($id);

        // Check if the current logged-in user is an admin (role 1 or 2)
        $currentUser = auth()->user();
        $isAdmin = in_array($currentUser->role, [1, 2]);

        // If the user is an admin, show all albums, otherwise only public albums
        if ($isAdmin) {
            // Fetch all albums (public and hidden)
            $albums = $user->albums()->paginate(5);
        } else {
            // Fetch only public albums
            $albums = $user->albums()->where('album_is_public', 1)->paginate(5);
        }

        // Return the view with the user and the filtered albums
        return view('users.albums', compact('user', 'albums', 'isAdmin'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit');
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
        $album = \App\Models\Album::findOrFail($id);

        // Check if the logged-in user is an admin (role 1) before deleting the album
        if (auth()->user()->role != 1) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the album
        $album->delete();

        return redirect()->back()->with('success', 'Album deleted successfully.');
    }
}
