<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    private int $paginateAmount = 8;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            // Redirect to login page if not logged in
            return redirect()->route('login')->with('error', 'You must be logged in to view your albums.');
        } else {

            $albums = \App\Models\Album::where('user_id', auth()->id())->paginate($this->paginateAmount);
            $genres = Genre::all();
            // Pass the paginated albums to the view
            return view('albums.item-page', ['albums' => $albums, 'genres' => $genres]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            $genre = Genre::all();
            return view('albums.add-album', compact('genre'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to store albums!');
        }

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

        // Additional album fields
        $album->image = null;
        $album->genre_id = $request->input('genre'); // Assign the genre selected by the user
        $album->user_id = auth()->id(); // Set the current user's ID

        // Handle the public checkbox input
        // If the checkbox is checked, it passes a value of '1'; if unchecked, it defaults to '0'.
        $album->album_is_public = $request->has('is_public') ? 1 : 0;

        // Save the album to the database
        $album->save();

        // Check the number of albums posted by the user
        $albumCount = \App\Models\Album::where('user_id', auth()->id())->count();


        return redirect()->route('albums.index')->with('success', 'Album created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::with('genre')->findOrFail($id);

        // Check if the album is public; if not, redirect to the welcome route
        if (!$album->album_is_public) {
            // if the album isn't public check if the user is logged in to see if they created it or are and admin
            if (auth()->check()) {
                // if the album is not public check if the user is an admin or the creator of the album
                if (auth()->user()->role !== 1 && auth()->id() !== $album->user_id) {
                    return redirect()->route('welcome');
                }
            } else {
                return redirect()->route('welcome');
            }
        }

        return view('albums.show-album', compact('album'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (auth()->check()) {
            $album = Album::findOrFail($id);

            // Check if the logged-in user is the owner of the album
            if (auth()->id() === $album->user_id) {
                $genre = Genre::all();
                return view('albums.edit-album', compact('album', 'genre'));
            } else {
                // Redirect to albums index if the user is not the owner
                return redirect()->route('albums.index')->with('error', 'You do not have permission to edit this album.');
            }
        } else {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete an album.');
        }

        $album = Album::findOrFail($id); // Get the album using the ID

        if (auth()->id() === $album->user_id) {
            return redirect()->route('albums.index')->with('error', 'You do not have permission to edit this album.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'year' => 'required|integer|min:0|max:2024',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre' => 'required|exists:genres,id',
        ]);

        // Update album details
        $album->name = $request->input('title');
        $album->artist = $request->input('artist');
        $album->year = $request->input('year');
        $album->genre_id = $request->input('genre');

        // Update public status based on checkbox
        $album->album_is_public = $request->has('is_public');

        if ($request->hasFile('img')) {
            // Delete the old image if it exists
            if ($album->image_url) {
                \Storage::delete($album->image_url);
            }

            // Store the new image
            $path = $request->file('img')->store('albums', 'public');
            $album->image_url = '/storage/' . $path;
        }

        // Save the album
        $album->save();

        return redirect()->route('albums.show', $album->id)->with('success', 'Album updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete an album.');
        }

        // Find the album or fail
        $album = Album::findOrFail($id);

        // Check if the authenticated user is the owner of the album or an admin
        if (auth()->user()->id !== $album->user_id && auth()->user()->role !== 1) {
            return redirect()->route('albums.index')->with('error', 'You do not have permission to delete this album.');
        }

        // Delete the album
        $album->delete();

        // Redirect after deletion
        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }

    public function search(Request $request)
    {
        // login check
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access the search feature.');
        }

        $query = $request->input('query');
        $genre = $request->input('genre');
        $year = $request->input('year');
        $rating = $request->input('rating');

        // Start building the query
        $albums = Album::query();

        // If any search parameters are present, apply them
        if ($query || $genre || $year || $rating) {
            // anonieme functie returned $q, wat het resultaat is van de 2 where queries
            $albums->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('artist', 'LIKE', "%{$query}%");
            });

            // Apply genre filter if selected
            if ($genre) {
                $albums->where('genre_id', $genre);
            }

            // Apply year filter if provided
            if ($year) {
                $albums->where('year', $year);
            }

            // Apply rating filter if provided
            if ($rating) {
                $albums->where('rating', '>=', $rating);
            }
        }

        // If no search parameters, return all albums (no filtering)
        // Paginate the results
        $albums = $albums->paginate($this->paginateAmount);

        // Assuming you pass the genres to the view for the dropdown
        $genres = Genre::all();

        return view('albums.item-page', compact('albums', 'genres'));
    }

}
