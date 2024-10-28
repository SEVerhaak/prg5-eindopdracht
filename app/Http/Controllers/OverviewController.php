<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use \App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OverviewController extends Controller
{
    private int $paginateAmount = 8;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('user')
        ->where('album_is_public', 1)
            ->whereHas('user', function($query) {
                // Only include albums from active users
                $query->where('is_public', 1);
            })
            ->paginate($this->paginateAmount);

        $genres = Genre::all();

        return view('overview.index', compact('albums', 'genres'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
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

    public function cheese()
    {
        Log::info('Cheese method was called.');

        return 'test';
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $genre = $request->input('genre');
        $year = $request->input('year');
        $rating = $request->input('rating');

        // Start building the query
        $albums = Album::query();

        // If any search parameters are present, apply them
        if ($query || $genre || $year || $rating) {
            $albums->where(function($q) use ($query) {
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

        // Paginate the results
        $albums = $albums->paginate($this->paginateAmount);

        // Assuming you pass the genres to the view for the dropdown
        $genres = Genre::all();

        return view('overview.index', compact('albums', 'genres'));
    }


}
