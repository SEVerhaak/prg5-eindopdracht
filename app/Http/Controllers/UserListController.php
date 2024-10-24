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

        // Get the logged-in user
        $loggedInUser = auth()->user();

        // Check if the logged-in user is an admin
        if ($loggedInUser->role == 1 || $loggedInUser->role == 2) {
            // If the user is an admin, show all users except the logged-in user
            $users = \App\Models\User::where('id', '!=', $loggedInUser->id) // Exclude the logged-in user
            ->withCount('albums')
                ->paginate(10);
        } else {
            // If the user is not an admin, show only public users except the logged-in user
            $users = \App\Models\User::where('is_public', 1)
                ->where('id', '!=', $loggedInUser->id) // Exclude the logged-in user
                ->withCount('albums')
                ->paginate(10);
        }

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
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the users.');
        }

        // Get the logged-in user
        $loggedInUser = auth()->user();

        // Check if the logged-in user is an admin
        if ($loggedInUser->role == 1 || $loggedInUser->role == 2) {
            // Admin can edit any user
            $user = \App\Models\User::withCount('albums')->findOrFail($id);
            return view('users.edit-user', compact('user'));
        } else {
            // Regular user can only edit their own account
            if ($loggedInUser->id == $id) {
                $user = \App\Models\User::withCount('albums')->findOrFail($id);
                return view('users.edit-user', compact('user'));
            }

            // If they are trying to access another user's edit page, redirect back
            return redirect()->back()->with('error', 'You do not have permission to edit this user.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|integer',
            'is_public' => 'boolean', // Validate as boolean
            'can_be_public' => 'boolean', // Validate as boolean
        ]);

        // Find the user by ID
        $user = \App\Models\User::findOrFail($id);

        // Update user details
        $user->name = $request->input('name');

        // Update role only if the logged-in user is an admin
        if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            $user->role = $request->input('role'); // Allow role change
        }

        // Check if the checkbox was checked and set the respective values
        $user->is_public = $request->has('is_public') ? 1 : 0; // Convert checkbox to 1/0
        $user->can_be_public = $request->has('can_be_public') ? 1 : 0; // Convert checkbox to 1/0

        // Save the updated user to the database
        $user->save();

        // Redirect back to the user list with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
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
