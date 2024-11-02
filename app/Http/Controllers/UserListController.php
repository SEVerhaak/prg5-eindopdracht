<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserListController extends Controller
{

    private int $paginateAmount = 8;

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

        // Album is linked to a user through the model
        // Then it counts the amount of linked albums to return a int
        $albumCount = $loggedInUser->albums()->count();

        // Redirect to error view if the user has fewer than 5 albums
        if ($albumCount < 5) {
            return view('users.error');
        }

        // Check if the logged-in user is an admin
        if ($loggedInUser->role == 1 || $loggedInUser->role == 2) {
            // If the user is an admin, show all users except the logged-in user
            $users = \App\Models\User::where('id', '!=', $loggedInUser->id) // Exclude the logged-in user
                ->withCount('albums')
                ->paginate($this->paginateAmount);
        } else {
            // If the user is not an admin, show only public users except the logged-in user
            $users = \App\Models\User::where('is_public', 1)
                ->where('id', '!=', $loggedInUser->id) // Exclude the logged-in user
                ->withCount('albums')
                ->paginate($this->paginateAmount);
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
            $albums = $user->albums()->paginate($this->paginateAmount);
        } else {
            // Fetch only public albums
            $albums = $user->albums()->where('album_is_public', 1)->paginate($this->paginateAmount);
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
            return redirect()->route('login')->with('error', 'You must be logged in to edit users.');
        }

        $this->checkAdmin();

        $user = \App\Models\User::withCount('albums')->findOrFail($id);
        return view('users.edit-user', compact('user'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Check if user is logged-in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit users.');
        }

        // Check if user is admin
        $this->checkAdmin();

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

        // Check if 'is_public' checkbox was checked
        if ($request->has('is_public')) {
            $user->is_public = 1;
        } else {
            $user->is_public = 0;
        }

        // Check if 'can_be_public' checkbox was checked
        if ($request->has('can_be_public')) {
            $user->can_be_public = 1;
        } else {
            $user->can_be_public = 0;
        }

        // Save the updated user to the database
        $user->save();

        // Redirect back to the user list with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit the users.');
        }

        $album = \App\Models\Album::findOrFail($id);

        // Check if the logged-in user is an admin (role 1) before deleting the album
        $this->checkAdmin();

        // Delete the album
        $album->delete();

        return redirect()->back()->with('success', 'Album deleted successfully.');
    }

    public
    function search(Request $request)
    {
        // login check
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the search feature.');
        }

        // Get the currently logged-in user's ID
        $loggedInUserId = auth()->id();
        $loggedInUser = \App\Models\User::find($loggedInUserId);

        // Start building the query with albums count
        $query = \App\Models\User::withCount('albums')
            ->where('id', '!=', $loggedInUserId); // Exclude the logged-in user

        // If the logged-in user is not an admin, restrict results to only active users
        if ($loggedInUser->role != 1 && $loggedInUser->role != 2) {
            $query->where('is_public', 1); // Only show public users
        }

        // Search by username if a query is provided
        if ($request->filled('query')) {
            $query->where('name', 'like', '%' . $request->input('query') . '%');
        }

        // Fetch the results with pagination
        $users = $query->paginate($this->paginateAmount);

        // Return the results to the view
        return view('users.index', compact('users'));
    }


    public function togglePublic(Request $request, $id)
    {

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to edit the user.');
        }

        $this->checkAdmin();

        // Find the user by ID
        $user = \App\Models\User::findOrFail($id);

        // Check if the checkbox is checked
        if ($request->has('is_public')) {
            $user->is_public = 1;
        } else {
            $user->is_public = 0;
        }

        $user->save();

        // Redirect
        return redirect()->route('users.index')->with('success', 'User status updated successfully.');
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
