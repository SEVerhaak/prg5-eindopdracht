<?php

namespace App\Http\Controllers;

use App\Models\tests;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate(['title' => 'required']);

        $category = new tests();
        $category->title = $request->input('title');
        $category->save();

        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(tests $tests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tests $tests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tests $tests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tests $tests)
    {
        //
    }
}
