<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class overviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            // Redirect to login page if not logged in
            return redirect()->route('login')->with('error', 'You must be logged in to view your albums.');
        }

        // Retrieve albums that belong to the authenticated user
        $albums = Album::where('user_id', auth()->id())->get();

        // Pass the albums to the view
        return view('item-page', ['albums' => $albums]);
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
