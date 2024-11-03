<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Genre;
use Illuminate\Http\Request;

class PublicOverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public int $paginateAmount = 8;

    public function index()
    {
        $query = '';
        // get all genres for the dropdown
        $genres = Genre::all();
        // get all public albums from public users
        $albums = Album::where('album_is_public', 1)
            // check that the user belonging to the album is set to public
            ->whereHas('user', function($query) {
                $query->where('is_public', 1);
            })
                ->paginate($this->paginateAmount);

        // pass the albums to the view
        return view('overview.index', compact('albums','genres', 'query'));
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
        // get all genres for the dropdown
        $genres = Genre::all();
        // get search from form input
        $query = $request->input('search');
        // get genre from form input
        $genreInput = $request->input('genre');

        // start a new query
        $albums = Album::query();

        // apply the public album filter
        $albums = $albums->where('album_is_public', 1)
            ->whereHas('user', function($query) {
                $query->where('is_public', 1);
            });

        // apply search filter if provided
        if ($query) {
            $albums->whereRaw("(name LIKE ? OR artist LIKE ?)", ["%{$query}%", "%{$query}%"]);
        }

        // apply genre filter if selected
        if ($genreInput) {
            $albums->where('genre_id', $genreInput);
        }

        // paginate results
        $albums = $albums->paginate($this->paginateAmount);

        return view('overview.index', compact('albums', 'genres', 'query'));
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
